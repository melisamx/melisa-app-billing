module.exports = function(grunt) {
    
    grunt.initConfig({
        main: {
            appName: 'Billing',
            src: 'resources/assets/',
            output: '../../public/<%= main.appName.toLowerCase() %>/',
            proyect: {
                name: 'Melisa Billing',
                version: '1.0.0',
                company: 'Melisa Company'
            }
        },
        less: {
            options: {
                compress: true
            },
            all: {
                files: {
                    '<%= main.output %>css/invoice-preview.min.css': '<%= main.src %>less/invoice-preview.less'
                }
            }
        },
        sass: {
            options: {
                style: 'compressed',
                noCache: true,
                sourcemap: 'none'
            },
            all: {
                files: {
                    '<%= main.output %>css/style.css': '<%= main.src %>sass/materialize.scss'
                }
            }
        },
        watch: {
            files: ['<%= main.src %>less/**/*.less'],
            tasks: ['less']
        }
    });
    
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.registerTask('default', [
        'watch'
    ]);
    
};
