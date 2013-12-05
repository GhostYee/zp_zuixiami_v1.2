seajs.config({  
  plugins: ['shim'],  
  alias: {    
    'jquery': {
      	src: 'jquery.min.js',
      	exports: 'jQuery'    
    }     
  }
  
});