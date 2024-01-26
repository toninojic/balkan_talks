module.exports = function(grunt) {
    grunt.initConfig({
        sass: {
            options: {
                implementation: require('sass'),
                sourceMap: true,
                outputStyle: 'compressed'
            },
            dist: {
                files: {
                    'assets/public/dist/css/style.css': 'assets/public/src/scss/style.scss'
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-sass');

    grunt.registerTask('default', ['sass']);

};
