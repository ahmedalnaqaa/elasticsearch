module.exports = function(grunt) {

    // Initializing the configuration object
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        // Task configuration
        less: {
            frontend: {
                files: {
                    './web/builds/css/application.css': './app/Resources/public/css/frontend.less'
                }
            },
            backend: {
                files: {
                    './web/builds/css/backend.application.css': './app/Resources/public/css/admin/*.less'
                }
            }
        },
        concat: {
            // CSS Frontend
            css_frontend_vendors: {
                src: [
                    './vendor/bower_components/bootstrap/dist/css/bootstrap.css',
                    './vendor/bower_components/font-awesome/css/font-awesome.css',
                    './vendor/bower_components/leaflet/dist/leaflet.css'
                ],
                dest: './web/builds/css/vendors.css'
            },
            css_frontend_build: {
                src: [
                    './web/builds/css/vendors.css',
                    './web/builds/css/application.css'
                ],
                dest: './web/builds/css/build.css'
            },

            // CSS Backend
            css_backend_vendors: {
                src: [
                    './vendor/bower_components/bootstrap/dist/css/bootstrap.css',
                    './vendor/bower_components/jquery-ui/themes/smoothness/jquery-ui.min.css',
                    './vendor/bower_components/leaflet/dist/leaflet.css'
                ],
                dest: './web/builds/css/backend.vendors.css'
            },
            css_backend_build: {
                src: [
                    './web/builds/css/backend.vendors.css',
                    './web/builds/css/backend.application.css'
                ],
                dest: './web/builds/css/backend.build.css'
            },

            // JS Frontend
            js_frontend_vendors: {
                src: [
                    './vendor/bower_components/jquery/dist/jquery.js',
                    './vendor/bower_components/angularjs/angular.js',
                    './vendor/bower_components/bootstrap/dist/js/bootstrap.js',
                    './vendor/bower_components/leaflet/dist/leaflet-src.js',
                    './vendor/bower_components/angular-leaflet-directive/dist/angular-leaflet-directive.js',
                    './vendor/bower_components/leaflet-plugins/layer/tile/Google.js',

                    './vendor/bower_components/blueimp-file-upload/js/vendor/jquery.ui.widget.js',
                    './vendor/bower_components/blueimp-load-image/js/load-image.all.min.js',
                    './vendor/bower_components/blueimp-canvas-to-blob/js/canvas-to-blob.min.js',
                    './vendor/bower_components/blueimp-file-upload/js/jquery.iframe-transport.js',
                    './vendor/bower_components/blueimp-file-upload/js/jquery.fileupload.js',
                    './vendor/bower_components/blueimp-file-upload/js/jquery.fileupload-process.js',
                    './vendor/bower_components/blueimp-file-upload/js/jquery.fileupload-image.js',
                    './vendor/bower_components/blueimp-file-upload/js/jquery.fileupload-audio.js',
                    './vendor/bower_components/blueimp-file-upload/js/jquery.fileupload-video.js',
                    './vendor/bower_components/blueimp-file-upload/js/jquery.fileupload-validate.js',
                    './vendor/bower_components/blueimp-file-upload/js/jquery.fileupload-angular.js',

                    './vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.js'
                ],
                dest: './web/builds/js/vendors.js'
            },
            js_frontend_build: {
                src: [
                    './web/builds/js/vendors.js',
                    './app/Resources/public/js/*.js'
                ],
                dest: './web/builds/js/build.js'
            },

            // JS Backend
            js_backend_vendors: {
                src: [
                    './vendor/bower_components/jquery/dist/jquery.js',
                    './vendor/bower_components/jquery-ui/jquery-ui.js',
                    './vendor/bower_components/angularjs/angular.js',
                    './vendor/bower_components/bootstrap/dist/js/bootstrap.js',
                    './vendor/bower_components/leaflet/dist/leaflet-src.js',
                    './vendor/bower_components/angular-leaflet-directive/dist/angular-leaflet-directive.js',
                    './vendor/bower_components/leaflet-plugins/layer/tile/Google.js'
                ],
                dest: './web/builds/js/backend.vendors.js'
            },
            js_backend_build: {
                src: [
                    './web/builds/js/backend.vendors.js',
                    './app/Resources/public/js/admin/*.js'
                ],
                dest: './web/builds/js/backend.build.js'
            }
        },
        uglify: {
            options: {
                mangle: false, // Use if you want the names of your functions and variables unchanged
                banner: '/*! <%= pkg.name %> - v<%= pkg.version %>: <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
            frontend_build: {
                files: {
                    './web/builds/js/build.min.js': './web/builds/js/build.js'
                }
            },
            backend_build: {
                files: {
                    './web/builds/js/backend.build.min.js': './web/builds/js/backend.build.js'
                }
            }
        },
        cssmin: {
            frontend_build: {
                options: {
                    banner: '/*! <%= pkg.name %>: Minified css file <%= grunt.template.today("yyyy-mm-dd") %> */\n'
                },
                files: {
                    './web/builds/css/build.min.css': ['./web/builds/css/build.css'],
                    './web/builds/css/bootstrap-rtl.min.css': ['./vendor/bower_components/bootstrap-rtl/dist/css/bootstrap-rtl.css']
                }
            },
            backend_build: {
                options: {
                    banner: '/*! <%= pkg.name %>: Minified css file <%= grunt.template.today("yyyy-mm-dd") %> */\n'
                },
                files: {
                    './web/builds/css/backend.build.min.css': ['./web/builds/css/backend.build.css']
                }
            }
        },
        copy: {
            main: {
                files: [
                    {
                        cwd: './vendor/bower_components/bootstrap/fonts/',
                        src: '*',
                        dest: './web/builds/fonts',
                        expand: true,
                        filter: 'isFile'
                    },
                    {
                        cwd: './vendor/bower_components/font-awesome/fonts/',
                        src: '*',
                        dest: './web/builds/fonts',
                        expand: true,
                        filter: 'isFile'
                    },
                    {
                        cwd: './vendor/bower_components/leaflet/dist/images/',
                        src: '*',
                        dest: './web/builds/css/images',
                        expand: true,
                        filter: 'isFile'
                    },
                    {
                        cwd: './web/fonts/',
                        src: '*',
                        dest: './web/builds/fonts',
                        expand: true,
                        filter: 'isFile'
                    },
                    {
                        cwd: './vendor/bower_components/jquery-ui/themes/smoothness/images/',
                        src: '*',
                        dest: './web/builds/css/images',
                        expand: true,
                        filter: 'isFile'
                    }
                ]
            }
        },
        watch: {

            // Watch CSS Frontend
            frontend_css: {
                files: [
                    './app/Resources/public/css/*'
                ],
                tasks: ['less:frontend', 'concat:css_frontend_build', 'cssmin:frontend_build'],
                options: {
                    spawn: false
                }
            },

            // Watch CSS Backend
            backend_css: {
                files: [
                    './app/Resources/public/css/admin/*'
                ],
                tasks: ['less:backend', 'concat:css_backend_build', 'cssmin:backend_build'],
                options: {
                    spawn: false
                }
            },

            // Watch JS Frontend
            frontend_js: {
                files: [
                    './app/Resources/public/js/*'
                ],
                tasks: ['concat:js_frontend_build', 'uglify:frontend_build'],
                options: {
                    spawn: false
                }
            },

            // Watch JS Backend
            backend_js: {
                files: [
                    './app/Resources/public/js/admin/*'
                ],
                tasks: ['concat:js_backend_build', 'uglify:backend_build'],
                options: {
                    spawn: false
                }
            }
        }
    });

    // Plugin loading
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Task definition
    grunt.registerTask('default', ['less', 'concat', 'uglify', 'cssmin', 'copy']);
};
