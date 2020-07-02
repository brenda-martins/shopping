-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 02-Jul-2020 às 09:53
-- Versão do servidor: 5.7.30-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `name` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parent` int(11) DEFAULT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`name`, `id`, `created_at`, `updated_at`, `parent`, `is_active`) VALUES
('Eletrônicos', 1, '2020-06-28 13:23:01', '2020-06-28 13:23:01', NULL, 1),
('Computadores', 2, '2020-06-29 13:43:19', '2020-06-29 13:43:19', 1, 1),
('Smartphones', 3, '2020-06-29 13:43:33', '2020-06-29 13:43:33', 1, 1),
('Jóias e Relógios', 4, '2020-06-29 13:44:08', '2020-06-29 13:44:08', NULL, 1),
('Brincos', 5, '2020-06-29 13:44:27', '2020-06-29 13:44:27', 4, 1),
('Colares', 6, '2020-06-29 13:44:32', '2020-06-29 13:44:32', 4, 1),
('Roupas', 7, '2020-07-02 11:41:34', '2020-07-02 11:41:34', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `shippingCharge` int(11) DEFAULT NULL,
  `productAvailability` varchar(50) DEFAULT NULL,
  `productDescription` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `category`, `name`, `price`, `image1`, `image2`, `image3`, `shippingCharge`, `productAvailability`, `productDescription`, `created_at`, `updated_at`) VALUES
(7, 1, 'Smartphone Samsung A8', 1780.96, 'storage/images/2020/07/samsung-1593690055.jpg', 'storage/images/2020/07/samsung-1593690055.jpg', 'storage/images/2020/07/samsung-1593690055.jpg', 0, 'Em estoque', 'Smartphone Samsung A8', '2020-07-02 11:40:55', '2020-07-02 11:40:55'),
(8, 7, 'Blusa Gucci', 150.88, 'storage/images/2020/07/1.jpg', 'storage/images/2020/07/1-1593690140.jpg', 'storage/images/2020/07/1-1593690140.jpg', 0, 'Em estoque', 'Blusa Gucci', '2020-07-02 11:42:20', '2020-07-02 11:42:20'),
(9, 1, 'Notebook Dell', 2780.99, 'storage/images/2020/07/57dfbf4df412f591937ee2ab0664d036.jpg', 'storage/images/2020/07/57dfbf4df412f591937ee2ab0664d036-1593690180.jpg', 'storage/images/2020/07/57dfbf4df412f591937ee2ab0664d036-1593690180.jpg', 0, 'Em estoque', 'Notebook Dell', '2020-07-02 11:43:00', '2020-07-02 11:43:00'),
(10, 1, 'Impressora', 1988.33, 'storage/images/2020/07/impressora-multifuncional-ecotank-l3150-epson-268672.jpg', 'storage/images/2020/07/impressora-multifuncional-ecotank-l3150-epson-268672-1593690213.jpg', 'storage/images/2020/07/impressora-multifuncional-ecotank-l3150-epson-268672-1593690213.jpg', 0, 'Em estoque', 'Impressora', '2020-07-02 11:43:33', '2020-07-02 11:43:33'),
(11, 3, 'Smartphone Motorola', 2780.96, 'storage/images/2020/07/motorola-1588679130-copia.jpg', 'storage/images/2020/07/motorola-1588679130-copia-1593693997.jpg', 'storage/images/2020/07/motorola-1588679130-copia-1593693997.jpg', 0, 'Em estoque', 'Motorola        ', '2020-07-02 12:46:37', '2020-07-02 12:46:37'),
(12, 3, 'Smartphone Xiaomi', 2788.33, 'storage/images/2020/07/tela-smartphone-xiaomi-redmi-8a.jpg', 'storage/images/2020/07/tela-smartphone-xiaomi-redmi-8a-1593694040.jpg', 'storage/images/2020/07/tela-smartphone-xiaomi-redmi-8a-1593694040.jpg', 0, 'Em estoque', 'Xiaomi', '2020-07-02 12:47:20', '2020-07-02 12:47:20'),
(13, 1, 'Smartphone Samsung A8', 1780.96, 'storage/images/2020/07/samsung-1593690055.jpg', 'storage/images/2020/07/samsung-1593690055.jpg', 'storage/images/2020/07/samsung-1593690055.jpg', 0, 'Em estoque', 'Smartphone Samsung A8', '2020-07-02 14:40:55', '2020-07-02 14:40:55'),
(14, 7, 'Blusa Gucci', 150.88, 'storage/images/2020/07/1.jpg', 'storage/images/2020/07/1-1593690140.jpg', 'storage/images/2020/07/1-1593690140.jpg', 0, 'Em estoque', 'Blusa Gucci', '2020-07-02 14:42:20', '2020-07-02 14:42:20'),
(15, 1, 'Impressora', 1988.33, 'storage/images/2020/07/impressora-multifuncional-ecotank-l3150-epson-268672.jpg', 'storage/images/2020/07/impressora-multifuncional-ecotank-l3150-epson-268672-1593690213.jpg', 'storage/images/2020/07/impressora-multifuncional-ecotank-l3150-epson-268672-1593690213.jpg', 0, 'Em estoque', 'Impressora', '2020-07-02 14:43:33', '2020-07-02 14:43:33'),
(16, 3, 'Smartphone Motorola', 2780.96, 'storage/images/2020/07/motorola-1588679130-copia.jpg', 'storage/images/2020/07/motorola-1588679130-copia-1593693997.jpg', 'storage/images/2020/07/motorola-1588679130-copia-1593693997.jpg', 0, 'Em estoque', 'Motorola        ', '2020-07-02 15:46:37', '2020-07-02 15:46:37'),
(17, 3, 'Smartphone Xiaomi', 2788.33, 'storage/images/2020/07/tela-smartphone-xiaomi-redmi-8a.jpg', 'storage/images/2020/07/tela-smartphone-xiaomi-redmi-8a-1593694040.jpg', 'storage/images/2020/07/tela-smartphone-xiaomi-redmi-8a-1593694040.jpg', 0, 'Em estoque', 'Xiaomi', '2020-07-02 15:47:20', '2020-07-02 15:47:20'),
(18, 1, 'Notebook Dell', 2780.99, 'storage/images/2020/07/57dfbf4df412f591937ee2ab0664d036.jpg', 'storage/images/2020/07/57dfbf4df412f591937ee2ab0664d036-1593690180.jpg', 'storage/images/2020/07/57dfbf4df412f591937ee2ab0664d036-1593690180.jpg', 0, 'Em estoque', 'Notebook Dell', '2020-07-02 14:43:00', '2020-07-02 14:43:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `name` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `forget` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`name`, `id`, `email`, `password`, `contact`, `forget`, `created_at`, `updated_at`, `admin`) VALUES
('Admin', 3, 'admin@email.com', '$2y$10$YWVV4v2mVk/BSzwfq2nQ4O0j57KlgcVC1fnM82DJyaSIgow3Ug5Ta', '(00)0000-0000', NULL, '2020-07-02 11:00:53', '2020-07-02 11:00:53', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
