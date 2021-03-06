<?php

class Categories_Glossary_Widget extends WPH_Widget {

  function __construct() {

    $plugin = Glossary::get_instance();
    $this->plugin_slug = $plugin->get_plugin_slug();

    $args = array(
	  'label' => __( 'Glossary Categories', $this->plugin_slug ),
	  'description' => __( 'List of Glossary Categories', $this->plugin_slug ),
    );

    $args[ 'fields' ] = array(
	  array(
		'name' => __( 'Title', $this->plugin_slug ),
		'desc' => __( 'Enter the widget title.', $this->plugin_slug ),
		'id' => 'title',
		'type' => 'text',
		'class' => 'widefat',
		'std' => __( 'Glossary Categories', $this->plugin_slug ),
		'validate' => 'alpha_dash',
		'filter' => 'strip_tags|esc_attr'
	  )
    );

    $this->create_widget( $args );
  }

  function widget( $args, $instance ) {
    $out = $args[ 'before_widget' ];
    // And here do whatever you want
    $out .= $args[ 'before_title' ];
    $out .= $instance[ 'title' ];
    $out .= $args[ 'after_title' ];
    $out .= '<div class="widget-glossary-category-list">';
    $out .= get_glossary_cats_list();
    $out .= '</div>';
    $out .= $args[ 'after_widget' ];
    echo $out;
  }

}

// Register widget
if ( !function_exists( 'glossary_categories_register_widget' ) ) {

  function glossary_categories_register_widget() {
    register_widget( 'Categories_Glossary_Widget' );
  }

  add_action( 'widgets_init', 'glossary_categories_register_widget', 1 );
}
