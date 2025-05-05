-- SQL database dump taken from phpMyAdmin

-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 05, 2025 at 06:07 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catsdelight`
--
DROP DATABASE IF EXISTS catsdelight;
CREATE DATABASE catsdelight;

use catsdelight;
-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
                                 `AdminLoginID` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`AdminLoginID`) VALUES
                                                 (1),
                                                 (2);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
                            `CommentID` int NOT NULL,
                            `ReviewID` int DEFAULT NULL,
                            `UserLoginID` int UNSIGNED DEFAULT NULL,
                            `CommentText` text NOT NULL,
                            `Likes` int DEFAULT '0',
                            `DateAndTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentID`, `ReviewID`, `UserLoginID`, `CommentText`, `Likes`, `DateAndTime`) VALUES
                                                                                                           (1, 2, 4, 'That seems so handy!', 0, '2025-04-27 18:42:27'),
                                                                                                           (2, 2, 3, 'That seems really handy, I don\'t have a cat but if I did I would buy this. ', 2, '2025-04-27 18:42:27'),
                                                                                                           (12, 2, 5, 'AppleJohn 92', 0, '2025-05-02 10:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
                         `LoginID` int UNSIGNED NOT NULL,
                         `Username` varchar(45) NOT NULL,
                         `Email` varchar(45) NOT NULL,
                         `Password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`LoginID`, `Username`, `Email`, `Password`) VALUES
                                                                     (1, 'Lan', 'lanngai@gmail.com', '$2y$10$pM0p45mixWXjBihZXGaHbe2j8OLft.6Ue4L6lG/ip8gW/w2mF7TkS'),
                                                                     (2, 'Fausta', 'f@gmail.com', '$2y$10$tX7SSAlshBiRtrWq2mWT7OTEjb1s8cJhPZkXR2t6qS84nAvernCQ6'),
                                                                     (3, 'Kevin', 'k@gmail.com', '$2y$10$2hl.LnAMLOLdfobKol32WOswJHWRxrBmdoTpqNQfZnFTTqeTwaANC'),
                                                                     (4, 'RobertS', 'rsmith@hotmail.com', '$2y$10$byNela/im9Y78uIsL04sBuGc7UZY31xjAGKim4NtvbASV5/iIt/8i'),
                                                                     (5, 'Nathan', 'johnbarry21@hotmail.com', '$2y$10$NXqKMIVk5wjSni7wBxcz4.0B/sFGPDVQVboEw03BUbAGhyynFFoaa'),
                                                                     (6, 'AngelaMerkel', 'am@gmail.com', '$2y$10$6P5UAVFTNOKbShvF3wg27OgX9aGhzsVBfUcf5fM9I0tA8Q2zLqs.O'),
                                                                     (7, 'Arnie', 'a@hotmail.com', '$2y$10$JVpr3e0XcEpM180PuudYO.V2dwtabD3l0NUA1HkiAKfHrsCDBitWK');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
                            `ProductID` int NOT NULL,
                            `AdminLoginID` int UNSIGNED DEFAULT NULL,
                            `ProductName` varchar(45) NOT NULL,
                            `ProductType` varchar(45) DEFAULT NULL,
                            `ProductDescription` text NOT NULL,
                            `ProductManufacturer` varchar(45) NOT NULL,
                            `ProductImage` varchar(45) DEFAULT NULL,
                            `ProductLink` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `AdminLoginID`, `ProductName`, `ProductType`, `ProductDescription`, `ProductManufacturer`, `ProductImage`, `ProductLink`) VALUES
                                                                                                                                                                   (1, 1, 'Automatic Cat Feeder with Timer for 2 Cats', 'Misc', '𝐍𝐨 𝐖𝐚𝐢𝐭𝐢𝐧𝐠, 𝐒𝐚𝐭𝐢𝐬𝐟𝐲 𝐓𝐡𝐞𝐢𝐫 𝐏𝐨𝐬𝐬𝐞𝐬𝐬𝐢𝐯𝐞𝐧𝐞𝐬𝐬: Cats are often possessive about their food and we hope to satisfy this adorable desire. oneisall PFD002 automatic cat feeder for 2 cats, no sharing, no waiting, symmetrical design, safeguarding their sense of security when eating', 'oneisall', 'feeder.jpg', 'https://www.amazon.de/oneisall-Futterautomat-Katzenfutter-Futterspender-Edelstahlschüssel/dp/B0C772KDKT/ref=asc_df_B0C772KDKT?mcid=3645139638993907b1c2e93b9ed339aa&th=1&psc=1&tag=googshopde-21&linkCode=df0&hvadid=696320211104&hvpos=&hvnetw=g&hvrand=11975259026166130322&hvpone=&hvptwo=&hvqmt=&hvdev=c&hvdvcmdl=&hvlocint=&hvlocphy=9043685&hvtargid=pla-2199343681099&psc=1&gad_source=1'),
                                                                                                                                                                   (2, 1, 'scratch me scratching post 50cm', 'Toy', 'completely wrapped in natural sisal\r\nrotatable pole with toy on string\r\nwith toy on spring\r\nsize: floor area 40 x 30cm, post height 50cm, ø 7cm\r\n3 colours: yellow, aqua, dark purple', 'Trixie', 'scratchingPost.jpg', 'https://www.petstop.ie/products/scratch-me-scratching-post-50cm?country=IE&gQT=1&variant=46984951071052'),
                                                                                                                                                                   (6, NULL, 'MjAMjAM Premium Wet Food for Cats', 'Food', 'MjAMjAM: Grain-free, natural complete food for cats with an extra-high meat content, monoprotein, important vitamins and minerals.\r\nComposition: Species-appropriate nutrition that is close to their natural diet in the wild.\r\nRegional: Consists of ingredients sourced from regional farms.\r\nControlled: The ingredients are subject to strict quality controls.\r\nAnimal welfare: Animal welfare is always our top priority during production.', 'MjAMjAM', 'wetFood.jpg', 'https://www.amazon.de/-/en/MjAMjAM-Premium-Chicken-Delicious-Grain-Free/dp/B07D4T5XVT/260-0382848-6192907?th=1'),
                                                                                                                                                                   (7, NULL, 'FUKUMARU Tofu Cat Litter', 'Litter', 'Natural ingredients cat litter – 80% tofu cat litter and 20% corn pellets, made with plant ingredients to eliminate odours, creates a safe cat litter. Suitable for most types of pets and litter boxes\r\nQuick clumping and easy rinsing: 2 seconds absorption and 3 seconds clumping of the cat litter. It easily forms dense, strong lumps, non-stick coating for easy cleaning, and the lump formation helps reduce odors. and the cat litter is biodegradable. The tofu cat litter can be rinsed away in the toilet.', 'FUKUMARU', 'tofuLitter.jpg', 'https://www.amazon.de/FUKUMARU-Katzenstreu-Klumpstreu-Maispellets-Geruchskontrolle/dp/B0CKPFFMHL/ref=asc_df_B0CKPFFMHL?mcid=742bb3846f81331f98f1602ea0911510&amp;th=1&amp;tag=googshopde-21&amp;linkCode=df0&amp;hvadid=696979561597&amp;hvpos=&amp;hvnetw=g&amp;hvrand=13821667814592067976&amp;hvpone=&amp;hvptwo=&amp;hvqmt=&amp;hvdev=c&amp;hvdvcmdl=&amp;hvlocint=&amp;hvlocphy=9043685&amp;hvtargid=pla-2274397831657&amp;gad_source=1');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
                           `ProfileID` int UNSIGNED NOT NULL,
                           `UserLoginID` int UNSIGNED DEFAULT NULL,
                           `Bio` varchar(300) DEFAULT 'Hello! I am a cat owner, I hope to find the best products for my kitties!',
                           `ProfileImage` varchar(45) DEFAULT NULL,
                           `TotalLikes` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`ProfileID`, `UserLoginID`, `Bio`, `ProfileImage`, `TotalLikes`) VALUES
                                                                                            (1, 3, 'Hello! My name is Kevin. Sadly my mom dislikes cats. We have a dog instead.', 'placeholder_pfp.jpg', 20),
                                                                                            (2, 4, 'Hello! My name is Robert.', 'RobertPfp.jpg', 0),
                                                                                            (3, 5, 'Hello! I am Nathan, I hope to find the best products for my kitties!', 'NathanPfp.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
                           `ReviewID` int NOT NULL,
                           `ProductID` int DEFAULT NULL,
                           `AdminLoginID` int UNSIGNED DEFAULT NULL,
                           `QualityRating` int DEFAULT NULL,
                           `PriceRating` int DEFAULT NULL,
                           `ReviewText` text,
                           `DateAndTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`ReviewID`, `ProductID`, `AdminLoginID`, `QualityRating`, `PriceRating`, `ReviewText`, `DateAndTime`) VALUES
                                                                                                                                 (2, 1, 1, 4, 4, 'I’m super impressed with this automatic cat feeder! One of my top priorities was ensuring each of my cats had their own bowl, and this design works perfectly for that. The setup process was straightforward, and I had it up and running in no time. The food storage compartment is secure, giving me peace of mind that the food stays fresh and safe.', '2025-03-22 16:00:00'),
                                                                                                                                 (3, 7, NULL, 5, 4, 'Very pleased with the purchase, previously I used the classic clay/pebble mix litter, and the dust is spread around the apartment was insane, and it was also very messy around the litter box.\r\n\r\nThis TOFU Cat Litter solved all the above mentioned problems:\r\n\r\n- It has absolutely 0 dust, even when pouring it out of the bag, meaning 0 litter dust gets spread around the apartment\r\n- Clumping is great and comparable to any other good cat litter\r\n- The smell is alright, next time I will be going for one of the TOFU scented versions, however even this one isn&#039;t bad - I just prefer a light pleasant scent\r\n\r\nAll in all, highly recommended cat litter to keep your apartment tidy, and cat happy', '2025-05-05 05:57:03');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
                        `UserLoginID` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserLoginID`) VALUES
                                       (3),
                                       (4),
                                       (5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
    ADD PRIMARY KEY (`AdminLoginID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
    ADD PRIMARY KEY (`CommentID`),
    ADD KEY `ReviewID` (`ReviewID`),
    ADD KEY `UserLoginID` (`UserLoginID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
    ADD PRIMARY KEY (`LoginID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
    ADD PRIMARY KEY (`ProductID`),
    ADD KEY `AdminLoginID` (`AdminLoginID`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
    ADD PRIMARY KEY (`ProfileID`),
    ADD KEY `UserLoginID` (`UserLoginID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
    ADD PRIMARY KEY (`ReviewID`),
    ADD KEY `ProductID` (`ProductID`),
    ADD KEY `AdminLoginID` (`AdminLoginID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`UserLoginID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
    MODIFY `AdminLoginID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
    MODIFY `CommentID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
    MODIFY `LoginID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
    MODIFY `ProductID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
    MODIFY `ProfileID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
    MODIFY `ReviewID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
    MODIFY `UserLoginID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
    ADD CONSTRAINT `administrator_ibfk_1` FOREIGN KEY (`AdminLoginID`) REFERENCES `login` (`LoginID`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
    ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`ReviewID`) REFERENCES `reviews` (`ReviewID`),
    ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`UserLoginID`) REFERENCES `user` (`UserLoginID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
    ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`AdminLoginID`) REFERENCES `administrator` (`AdminLoginID`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
    ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`UserLoginID`) REFERENCES `user` (`UserLoginID`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
    ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`),
    ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`AdminLoginID`) REFERENCES `administrator` (`AdminLoginID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
    ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`UserLoginID`) REFERENCES `login` (`LoginID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;