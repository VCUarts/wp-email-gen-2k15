module.exports = function(grunt) {
 
    // 1. All configuration goes here
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        // Grunt-sass 
        sass: {
          app: {
            files: [{
              expand: true,
              cwd: 'library/scss',
              src: ['*.scss'],
              dest: 'library/css',
              ext: '.css'
            }]
          },
          options: {
            sourceMap: false, 
            outputStyle: 'compact', 
            imagePath: "library/images",
          }
        },

        watch: {
            scss: {
                files: ['library/scss/**/*.scss'],
                tasks: ['sass', 'autoprefixer', 'cssmin']
            },
            css: {
                files: ['library/css/**/*.css']
            },
            livereload: {
                files: ['**/*.html', '**/*.php', '**/*.js', '**/*.css', '!**/node_modules/**'],
                options: { livereload: true }
            }
        },
 
        autoprefixer: {
            dist: {
                files: {
                    'library/css/style.css' : 'library/css/style.css'
                }
            }
        },
 
        cssmin: {
            options: {
                report: 'min',
                keepBreaks: true,
                keepSpecialComments: 0
            },
            combine: {
                files: {
                    'library/css/style.css': ['library/css/style.css']
                }
            }
        },

        concurrent: {
            watch: {
                tasks: ['watch', 'sass'],
                options: {
                    logConcurrentOutput: true
                }
            }
        },

        copy: {
          main: {
            files: [
              // includes files within path and its sub-directories
                {
                expand: true, 
                src: ['**','!build/**','!bower_components/**','!node_modules/**','!.git/**','!library/scss/**'], dest: 'build/'
                },
            ],
          },
        }, 
    });
 
    // 3. Where we tell Grunt what plugins to use
 
    // Sass
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
 
    // Browser Reload + File Watch
    grunt.loadNpmTasks('grunt-concurrent');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Build Related
    grunt.loadNpmTasks('grunt-contrib-copy');
 
    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('init', ['build']);
    grunt.registerTask('dev', ['watch']);
    grunt.registerTask('build', ['sass', 'autoprefixer', 'cssmin', 'copy']);
};