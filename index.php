<?php
  /**
   * Created by PhpStorm.
   * User: IROXIT
   * Date: 24/01/2017
   * Time: 03:32 PM
   */
  use Crayon\Comprobante\ComprobanteFiscalGeneric;

  include_once __DIR__ . '/vendor/autoload.php';
  include_once __DIR__ . '/src/autoload.php';

  const FILE_PATH = "./files/";
  const TEMPLATE_DIR = "./src/Templates";

  $twig_renderer = new \Crayon\Utils\TwigEnv([TEMPLATE_DIR]);

  $directoryIterator = new RecursiveDirectoryIterator(FILE_PATH,
    FilesystemIterator::SKIP_DOTS|FilesystemIterator::UNIX_PATHS);
  $recursiveIterator = new RecursiveIteratorIterator($directoryIterator);

  /** @var SplFileInfo $file */
  foreach($recursiveIterator as $file){
    $comprobante = new ComprobanteFiscalGeneric($file->getRealPath());
    echo $twig_renderer->render('Comprobante', ['comprobante' => $comprobante]);
  }