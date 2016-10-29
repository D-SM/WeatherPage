/* diabelek: kolumny nie są prefiksowane
 * nazwa tabeli niewiele mówi - lepsza będze user_cities
 */
CREATE TABLE IF NOT EXISTS `cities` (
  `user_id` int(10) NOT NULL,
  `city_name` varchar(50) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;