<?php
class DB {

	///gera a tabela no banco de dados
	public static function gera_tabela() {
	   //Montra scritp da tabela
		global $wpdb;
		$nometabela = $wpdb->prefix . 'apiki_favorite_post';
		$script_sql = "CREATE TABLE ".$nometabela ." ( `post_id` INT NOT NULL , `user_id` INT NOT NULL , `data` DATE NOT NULL , INDEX `PostID` (`post_id`, `user_id`)) ENGINE = InnoDB;";

		$query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $nometabela ) );

		if ( $wpdb->get_var( $query ) === $nometabela ) {
			return true;
		}

		$wpdb->query( $script_sql );

		if ( $wpdb->get_var( $query ) === $nometabela ) {
			return true;
		}

		return false;
	}
}