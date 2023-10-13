# WPSPATheme
WordPress SPA Theme alternative of MVC Extension of the client wants work inside the theme

```PHP
   SPA Folder Structure
   > Themes
     > YourTheme
       > init
         > initAction

```

```PHP
    // functions.php theme file
    # Register new action!
    add_action('init', function() { ___initActions('initActions'); });

    function ___initActions( $___directories = null , bool $sc = false ) : void { 

     if(!is_null($___directories)) {   

      $___spa_directory = get_theme_file_path( 
           apply_filters( 'init_directory', '/init/' ) . $___directories .'/'
      );

      $___spaAllRun = new DirectoryIterator( $___spa_directory );  
      foreach ($___spaAllRun as $appRequest) {  
      
      if (!$appRequest->isDot() && $sc != true ) {  require ( $___spa_directory . $appRequest->getFilename() ); 
      } else if (!$appRequest->isDot() && $sc == true ) { 
       require_once( $___spa_directory . $appRequest->getFilename() ); 
      } 
   }

  }  
```

<h2>Hooks</h2>

```PHP
 
 # init_directory : Replace default init file_name folder for the main SPA structure
 # From folder named: init
 # To newDirectory

 // Usage: 
 add_filter('init_directory', function() {
   return 'newDirectory';
 }); 

```



