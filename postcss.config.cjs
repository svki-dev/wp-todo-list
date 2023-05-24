module.exports = {
    plugins: [
        // requre('cssnano'),
        require('autoprefixer'),
        require('postcss-import'),
        require('postcss-preset-env')({
            stage: 1,
        }),
        require('postcss-nested'),
    ]
}