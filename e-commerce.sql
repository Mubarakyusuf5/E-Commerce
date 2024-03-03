-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2024 at 07:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `cprice` int(40) NOT NULL,
  `cquantity` int(30) NOT NULL,
  `cimage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` int(11) NOT NULL,
  `chName` varchar(100) NOT NULL,
  `chNumber` int(50) NOT NULL,
  `chEmail` varchar(100) NOT NULL,
  `chPay` varchar(100) NOT NULL,
  `chAd1` varchar(255) NOT NULL,
  `chCity` varchar(50) NOT NULL,
  `chState` varchar(50) NOT NULL,
  `chCountry` varchar(50) NOT NULL,
  `chCode` varchar(50) NOT NULL,
  `tproducts` varchar(300) NOT NULL,
  `tprice` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pprice` int(100) NOT NULL,
  `pdesc` varchar(255) NOT NULL,
  `pcategory` varchar(255) NOT NULL,
  `pimage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `pname`, `pprice`, `pdesc`, `pcategory`, `pimage`) VALUES
(17, 'Hamburger', 5000, 'Corporis repellendus jbjbjkbkvb jkbvjbfbo bbbvabm,bv,Bio jbvuiobuvabjbvibv bvuoibabvjb', 'Food & Beverage', '—Pngtree—hamburger chicken takeaway food_6598805.png'),
(18, 'Dune', 1500, 'Dune [4K Ultra HD Blu-ray/Blu-ray] [2021]', 'Books & Media', 'lf (3).webp'),
(19, 'Piper Calhoun', 702, 'Dolorem atque obcaec', 'Jewelry & Accessories', 'pizza-transparent.png'),
(20, 'hamburger', 19, 'cntf u fy fu  g iyr fgfcrybf', 'Food & Beverage', 'pizza-transparent.png'),
(21, 'Lael Roach', 151, 'Ut aut officia asper', 'Food & Beverage', 'tinywow_change_bg_photo_48892551.png'),
(22, 'Taco', 238, 'Ex fugiat ex dolor d', 'Food & Beverage', 'tinywow_change_bg_photo_48892705.png'),
(23, 'Galaxy Book4 Pro', 900000, 'Laptop | 3K AMOLED | Touchscreen', 'Electronics', 'tinywow_change_bg_photo_48902479.png'),
(24, 'MacBook Pro', 1599, '14-inch Liquid Retina XDR display²\r\nTwo Thunderbolt / USB 4 ports, HDMI port, SDXC card slot, headphone jack, MagSafe 3 port', 'Electronics', 'tinywow_change_bg_photo_48893289.png'),
(25, 'Iphone 15', 799, 'The latest pink colored iphone 15with 64gb of ram and 1tb of rom ', 'Electronics', 'tinywow_change_bg_photo_48893568.png'),
(26, 'Samsung s23 ultra', 2000, 'The lemon green s23 ultra straight out of the pot', 'Electronics', 'tinywow_change_bg_photo_48894102.png'),
(27, 'Samsung s23+', 2000, 'The main black Samsung s23+, never seen before', 'Electronics', 'tinywow_change_bg_photo_48894144.png'),
(28, 'Iphone 15 pro', 799, 'The one and only iphone 15 pro max', 'Electronics', '15_pro-removebg-preview.png'),
(29, 'Magnum Black Ring', 218000, 'Magnum black diamond wedding band', 'Jewelry & Accessories', 'tinywow_change_bg_photo_48952340.png'),
(30, 'Astrid Sterling Ring', 128000, 'Astrid sterling silver engagement ring.', 'Jewelry & Accessories', 'tinywow_change_bg_photo_48952227.png'),
(31, 'Chiara Gold Pendant / Chain', 490000, 'Chiara 9kt gold pendant and chain', 'Jewelry & Accessories', 'tinywow_change_bg_photo_48952714.png'),
(32, 'Casio MTP-VD300', 65000, 'Men\'s enticer chronograph black resin sports watch', 'Jewelry & Accessories', 'Untitled-design-81-removebg-preview.png'),
(33, 'Rotary GS05328', 366300, 'Men\'s windsor gold case multifunction medium watch.', 'Jewelry & Accessories', 'tinywow_change_bg_photo_48953709.png'),
(34, 'HF Flag', 42498, 'HF Flag Striped Cotton Long Sleeve Button Down - Navyblue', 'Clothing & Apparel', 'tinywow_change_bg_photo_48954788.png'),
(35, 'PRL', 43748, 'PRL Essential Men\'s Custom Fit Striped Long Sleeve Shirt- Ash', 'Clothing & Apparel', 'prl-essential-men-s-custom-fit-striped-long-sleeve-shirt-ash-obeezi-com-1-removebg-preview.png'),
(36, 'Kenz Paris', 68748, 'Kenz Paris Full Embroidered Tiger Head Hooded Tracksuit - Black', 'Clothing & Apparel', 'kenz-paris-full-embroidered-tiger-head-hooded-tracksuit-navy-blue-obeezi-com.webp'),
(37, 'Nike Jordan Low 1', 77498, 'NK 1 Low N7 LV8 Utility Suede Patterned Sneakers - Multicolor', 'Clothing & Apparel', 'nk-1-low-n7-lv8-utility-suede-patterned-sneakers-multicolor-obeezi-com-1-removebg-preview.png'),
(38, 'Adidas Traxion', 74988, 'Adidas Traxion Summer 3 Stripes Sneakers- Black', 'Clothing & Apparel', 'ad-traxion-summer-3-stripes-sneakers-black-obeezi-com-1-removebg-preview.png'),
(39, 'The Hunter', 40000, 'The Hunter (Signed B&N Exclusive Book)', 'Books & Media', 'lf.webp'),
(40, 'Dune', 20000, 'A masterpiece of the Science Fiction genre.', 'Books & Media', 'lf (1).webp'),
(41, 'Yellow Face(eBook)', 15000, '“Hard to put down, harder to forget.” — Stephen King, #1 New York Times bestselling author', 'Books & Media', 'lf (2).webp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `uname`, `email`, `password`) VALUES
(1, 'Mubarak Yusuf', 'Mubarak45', 'yusufmubarak460@gmail.com', 'mubarak '),
(2, 'Muduru', 'Muduru67', 'muduru@gmail.com', '134567'),
(20, 'Abdulrahman kalli', 'kalli34', 'mubarakibrahimyusuf7@gmail.com', '134567');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
