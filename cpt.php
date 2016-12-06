<?php 

	Class pixel_core_cpt {

		private $cpt = array();
		private $cat = array();
		private $tax = array();

		public function addCpt( $singular, $plural, $slug, $args = array()){
			
			$this->cpt['singluar'] = esc_attr($singular);
			$this->cpt['plural'] = esc_attr($plural);
			$this->cpt['slug'] = esc_attr($slug);


			if(!empty($args) && is_array($args)){
				$this->cpt['args'] = $args;
			}

			add_action( 'init', array(&$this, '_addCptFn'));
		}	

		public function addTax( $singular, $plural, $slug, $args = array() ){

			$this->tax['singluar'] = esc_attr($singular);
			$this->tax['plural'] = esc_attr($plural);
			$this->tax['slug'] = esc_attr($slug);

			if(!empty($args) && is_array($args)){
				$this->tax['args'] = $args;
			}

			add_action( 'init', array(&$this, '_addTaxFn'));
		}

		public function addCat( $singular, $plural, $slug, $args = array() ){
			
			$this->cat['singluar'] = esc_attr($singular);
			$this->cat['plural'] = esc_attr($plural);
			$this->cat['slug'] = esc_attr($slug);
			
			if(!empty($args) && is_array($args)){
				$this->cat['args'] = $args;
			}

			add_action( 'init', array(&$this, '_addCatFn'));
		}

		//

		public function _addCptFn(){

			$labels = array(
				'name'                => _x( $this->cpt['plural'], 'Post Type General Name', 'text_domain' ),
				'singular_name'       => _x( $this->cpt['singluar'], 'Post Type Singular Name', 'text_domain' ),
				'menu_name'           => __( $this->cpt['singluar'], 'text_domain' ),
				'name_admin_bar'      => __( $this->cpt['singluar'], 'text_domain' ),
				'parent_item_colon'   => __( $this->cpt['singluar'] . ' Item:', 'text_domain' ),
				'all_items'           => __( 'All Items', 'text_domain' ),
				'add_new_item'        => __( 'Add New Item', 'text_domain' ),
				'add_new'             => __( 'Add New', 'text_domain' ),
				'new_item'            => __( 'New Item', 'text_domain' ),
				'edit_item'           => __( 'Edit Item', 'text_domain' ),
				'update_item'         => __( 'Update Item', 'text_domain' ),
				'view_item'           => __( 'View Item', 'text_domain' ),
				'search_items'        => __( 'Search Items', 'text_domain' ),
				'not_found'           => __( 'Not found', 'text_domain' ),
				'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
			);
			$args = array(
				'label'               => __( $this->cpt['singluar'], 'text_domain' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
				'taxonomies'          => array( ),
				'hierarchical'        => true,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 20,
				'show_in_admin_bar'   => false,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => true,		
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'page',
			);

			// overide default args
			if(isset($this->cpt['args']) && !empty($this->cpt['args'])){
				$args = $this->cpt['args'];
			}

			register_post_type( $this->cpt['slug'], $args );

		}

		public function _addCatFn(){

			$labels = array(
				'name'                       => _x( $this->cat['plural'], 'basejump' ),
				'singular_name'              => _x( $this->cat['singluar'], 'basejump' ),
				'menu_name'                  => __( $this->cat['plural'], 'basejump' ),
				'all_items'                  => __( 'All Items', 'basejump' ),
				'parent_item'                => __( 'Parent Item', 'basejump' ),
				'parent_item_colon'          => __( 'Parent Item:', 'basejump' ),
				'new_item_name'              => __( 'New Item Name', 'basejump' ),
				'add_new_item'               => __( 'Add New Item', 'basejump' ),
				'edit_item'                  => __( 'Edit Item', 'basejump' ),
				'update_item'                => __( 'Update Item', 'basejump' ),
				'view_item'                  => __( 'View Item', 'basejump' ),
				'separate_items_with_commas' => __( 'Separate items with commas', 'basejump' ),
				'add_or_remove_items'        => __( 'Add or remove items', 'basejump' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'basejump' ),
				'popular_items'              => __( 'Popular Items', 'basejump' ),
				'search_items'               => __( 'Search Items', 'basejump' ),
				'not_found'                  => __( 'Not Found', 'basejump' ),
			);
			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => true,
			);

			if(isset($this->cat['args']) && !empty($this->cat['args'])){
				$args = $this->cat['args'];
			}


			register_taxonomy( $this->cat['slug'], array( $this->cpt['slug'] ), $args );

		}	

		public function _addTaxFn( ){

			$labels = array(
				'name'                       => _x( $this->tax['plural'], 'basejump' ),
				'singular_name'              => _x( $this->tax['singluar'], 'basejump' ),
				'menu_name'                  => __( $this->tax['plural'], 'basejump' ),
				'all_items'                  => __( 'All Items', 'basejump' ),
				'parent_item'                => __( 'Parent Item', 'basejump' ),
				'parent_item_colon'          => __( 'Parent Item:', 'basejump' ),
				'new_item_name'              => __( 'New Item Name', 'basejump' ),
				'add_new_item'               => __( 'Add New Item', 'basejump' ),
				'edit_item'                  => __( 'Edit Item', 'basejump' ),
				'update_item'                => __( 'Update Item', 'basejump' ),
				'view_item'                  => __( 'View Item', 'basejump' ),
				'separate_items_with_commas' => __( 'Separate items with commas', 'basejump' ),
				'add_or_remove_items'        => __( 'Add or remove items', 'basejump' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'basejump' ),
				'popular_items'              => __( 'Popular Items', 'basejump' ),
				'search_items'               => __( 'Search Items', 'basejump' ),
				'not_found'                  => __( 'Not Found', 'basejump' ),
			);
			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => false,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => true,
			);

			if(isset($this->tax['args']) && !empty($this->tax['args'])){
				$args = $this->tax['args'];
			}

			register_taxonomy( $this->tax['slug'], array( $this->cpt['slug'] ), $args );
		}
		
	}
