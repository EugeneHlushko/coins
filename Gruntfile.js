module.exports = function(grunt) {
    grunt.initConfig({
        watch: {
            default: {
                files: ['sources/scss/**', 'sources/js/**'],
                tasks: ['dist'],
                options: {
                    livereload: true,
                    spawn: false
                }
            }
        },
        sass: {
            dist: {
                options: {
                    style: 'compressed',
                    sourcemap: 'none'
                },
                src: [
                    'sources/scss/index.scss'
                ],
                dest: 'web/assets/css/styles.min.css'
            }
        },
        autoprefixer:{
            dist:{
                files:{
                    'web/assets/css/styles.min.css':'web/assets/css/styles.min.css'
                }
            }
        },
        uglify: {
            options: {
                mangle: false,
                sourcemap: true
            },
            appMinJs: {
                files: {
                    'web/assets/js/app.min.js': [
                        'sources/js/app.js'
                    ]
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-autoprefixer');

    grunt.registerTask('dist', ['sass:dist', 'autoprefixer:dist', 'uglify:appMinJs']);

};
