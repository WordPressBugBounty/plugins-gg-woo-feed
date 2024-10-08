<?php
namespace GG_Woo_Feed\Core;
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use GG_Woo_Feed\Core\Object_Registry;

/**
 * Abstract class to define/implement base methods for all controller classes
 *
 * @since      1.0.0
 * @package    GG_Woo_Feed
 * @subpackage GG_Woo_Feed/controllers
 */
abstract class Controller {


	protected $model;


	protected $view;


	public static function get_instance( $model_class_name = false, $view_class_name = false ) {
		$obj_reg = (new class { use Object_Registry; });

		$classname = get_called_class();
		$key_in_registry = $obj_reg::get_key( $classname, $model_class_name, $view_class_name );

		$instance = $obj_reg::get( $key_in_registry );

		// Create a object if no object is found.
		if ( null === $instance ) {

			 $model = null;
			 $view = null;

			$instance = new $classname( $model, $view );

			$obj_reg::set( $key_in_registry, $instance );
		}

		return $instance;
	}


	protected function get_model() {
		return $this->model;
	}
}


