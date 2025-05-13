<?php

class ContainerDI
{
    public Array $classStore;
    public Array $classStoreLC;
    public Array $classStoreNotFound;
    public Array $classMethods;
    public Array $fileSearchStore;


    public function __construct(){
        $this->classStore = [];
        $this->classStoreLC = [];
        $this->classStoreNotFound = [];

        spl_autoload_register(function ($className) {

            $filename = str_replace('_', DIRECTORY_SEPARATOR, $className).'.php';
            $filepath = __DIR__ . "/" . $filename;
            $verifiedFile = $this->file_exists_ci($filepath);
      
            // Si le fichier n'est pas trouvé
            if ( !$verifiedFile ) {
              $this->classStoreNotFound[] = ['filename' => $filename, 'filepath' => $filepath, 'filesSearched' => $verifiedFile];
              return FALSE;
            }
      
            // Stockage du nom de la classe en minuscule
            // pour permettre la recherche si le nom de classe est fourni a get() en minuscule
            $this->classStoreLC[strtolower($className)] = [
              'nameRealCase' => $className,
              'filepath' => $filepath,
              'filename' => $verifiedFile
            ];
      
            // Inclusion du fichier
            require $verifiedFile;
      
          });
    }

    public function get($className, $param=NULL){
        $classNammeRealCase = $className;

        if (isset($this->classStore[$className])){
            return $this->classStore[$className];
        } 
        
        
        else {
            if (!class_exists($className)) return;
            $this->classStore[$className] = new $className($this,$param);
            return $this->classStore[$className];
        }
    }

    public function file_exists_ci($file) {
        if (file_exists($file))
          return $file;
      
        $lowerfile = strtolower($file);
      
        foreach (glob(dirname($file) . '/*')  as $fileInDir) {
          if (strtolower($fileInDir) == $lowerfile)
            return $fileInDir;
        }
        return FALSE;
      }
}