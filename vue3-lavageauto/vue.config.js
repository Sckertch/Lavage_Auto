const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true
})

module.exports = {
  devServer: {
    proxy: {
      '^/api': {
        target: 'http://localhost', // Adresse du serveur PHP
        changeOrigin: true,
        pathRewrite: { '^/api': '' },
      },
    },
  },
};
