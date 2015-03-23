module.exports = function (grunt) {
    grunt.initConfig({
        sass: {
            development: {
                files: {
                    "css/geschlossenraum.css": "sass/geschlossenraum.scss"
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-sass');

    grunt.registerTask('default', ['sass']);
};
