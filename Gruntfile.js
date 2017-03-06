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
            sourcemap: 'none', 
            outputStyle: 'compressed', 
            imagePath: "library/images",
          }
        },

        watch: {
            scss: {
                files: ['library/scss/**/*.scss'],
                tasks: ['sass', 'autoprefixer']
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

        concurrent: {
            watch: {
                tasks: ['watch', 'sass'],
                options: {
                    logConcurrentOutput: true
                }
            }
        },
    });
 
    // 3. Where we tell Grunt what plugins to use
 
    // Sass
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-autoprefixer');
 
    // Browser Reload + File Watch
    grunt.loadNpmTasks('grunt-concurrent');
    grunt.loadNpmTasks('grunt-contrib-watch');
 
    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('init', ['build']);
    grunt.registerTask('dev', ['watch']);
    grunt.registerTask('build', ['sass', 'autoprefixer']);
};