<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'commerce');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'sXRttC@OVM&1tk6_zTJTj0-ELc<9IK^605%CYD&yClLY%=0}D)! /<!u_@B)Lkx{');
define('SECURE_AUTH_KEY',  'mf*j1mYqmZ1iM|C550M[qLYJ/4n9oj9z r.g-X{e ^Yg%Nm,Ar|P>+x:?aomu Jq');
define('LOGGED_IN_KEY',    ' tPHlAb8(Rkb 5+ey0Fl7.QO^vc0} =L*2I4ai57yUc8sS&&,BGVSX*n*sgx4^-8');
define('NONCE_KEY',        'V{/:aTHH6pi%F~/kTQvzQ-|?yYSb,<*7s&}@U^:DH-C8:Rq]x^n:/ X,$C9|3ON0');
define('AUTH_SALT',        'V*7B/=X#tF>0<fq^~7=x;nJ}EX@nw(8vd1guJ. Z_&Uhswlz.HlwANUp(/k{~M&p');
define('SECURE_AUTH_SALT', 'xo&Ad`C6c}_q{77[g):Eak(*Gp0wYBKTdi(Ygi?8 fHe152Su  |zcGELGf:yY~$');
define('LOGGED_IN_SALT',   '@DpS(Z].J#5Uc=t|C.j<&NRWf0Dwp*I/WoD^*=O:,_vHXK~Ls;dt:O`473(Dv  J');
define('NONCE_SALT',       'H[n;*-BB:R=:%0y&k;i!4$~Q4!m@$AQTK+rIV(5Ez$f0ZK+~<e>jsWW6;r-@[DeW');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', FALSE);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');