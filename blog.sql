-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 13, 2021 at 03:28 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `blog`
--

CREATE DATABASE IF NOT EXISTS `blog` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `blog`;
-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
                            `id_comment` int(11) NOT NULL,
                            `post_id` int(11) NOT NULL,
                            `author_comment` int(11) NOT NULL,
                            `comment` text NOT NULL,
                            `comment_date` datetime NOT NULL,
                            `is_approved` tinyint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id_comment`, `post_id`, `author_comment`, `comment`, `comment_date`, `is_approved`) VALUES
                                                                                                                 (45, 15, 33, 'Cool', '2021-08-10 23:31:14', 0),
                                                                                                                 (47, 14, 33, 'Cool', '2021-08-10 23:33:46', 1),
                                                                                                                 (51, 15, 33, 'Super', '2021-08-11 09:05:18', 1),
                                                                                                                 (52, 13, 33, 'C\'est vrai !', '2021-08-12 17:23:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `fragment` text NOT NULL,
  `content` text NOT NULL,
  `author_post` int(11) NOT NULL,
  `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `fragment`, `content`, `author_post`, `creation_date`) VALUES
(13, 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra, ligula ut posuere maximus, dui augue consequat felis, eget dictum enim odio ut nibh. Vivamus in tortor urna. Vestibulum vitae pretium nibh. Aenean placerat ex sem. Sed dictum commodo mollis. Nunc aliquet sagittis ex sed tempus. Mauris aliquam urna id bibendum viverra. Pellentesque finibus tristique fringilla. Suspendisse sem nulla, cursus ut tempus eu, varius non diam.\r\n\r\nNam egestas consectetur sagittis. Maecenas eu purus nibh. Pellentesque fringilla neque eu dolor malesuada, non fermentum leo imperdiet. Vestibulum mollis, lacus et tempor posuere, risus libero ultrices ipsum, vitae mollis risus ipsum sed felis. Cras nec euismod eros, a consectetur tortor. Etiam bibendum aliquam metus ut faucibus. Sed pulvinar sollicitudin purus id scelerisque.', 'Ut gravida pellentesque mauris ut pretium. Nam pellentesque accumsan urna at porttitor. Curabitur mollis finibus lorem, vitae dictum nulla porttitor in. Integer id justo at sem tincidunt feugiat fermentum interdum enim. Vivamus ex neque, tempus sit amet bibendum sed, egestas eu est. In ullamcorper dictum felis, non viverra nisl rhoncus eu. Curabitur vel hendrerit nisl. Aenean vehicula consectetur libero porttitor fermentum. Etiam quis est semper, blandit orci a, fermentum ex. Nunc lacinia ex ut scelerisque sodales. Suspendisse congue varius orci sit amet lacinia. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nec magna a lacus eleifend accumsan.\r\n\r\nCras volutpat accumsan massa, blandit accumsan est suscipit sit amet. Nunc porta dignissim enim, aliquam ultricies odio sagittis vel. Quisque mollis est id molestie egestas. Cras facilisis eros risus, volutpat posuere felis placerat in. Pellentesque quis ipsum eu neque consequat gravida eget nec augue. Aenean in justo nulla. Integer ornare nisi eget mi dignissim, a tincidunt leo laoreet. Sed luctus ipsum at dui luctus suscipit ac id ligula. Curabitur egestas eleifend tellus, in mollis justo. Integer quis dolor condimentum, venenatis nisl eu, eleifend orci. Phasellus pulvinar, lorem nec ultricies suscipit, sem nisl tincidunt mauris, sed fringilla lorem ex finibus lacus. Maecenas nunc eros, euismod vitae euismod sed, fermentum aliquam magna. Aenean nec lectus maximus, fermentum nunc vel, laoreet ipsum.', 3, '2021-07-02 16:55:26'),
(14, 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra, ligula ut posuere maximus, dui augue consequat felis, eget dictum enim odio ut nibh. Vivamus in tortor urna. Vestibulum vitae pretium nibh. Aenean placerat ex sem. Sed dictum commodo mollis. Nunc aliquet sagittis ex sed tempus. Mauris aliquam urna id bibendum viverra. Pellentesque finibus tristique fringilla. Suspendisse sem nulla, cursus ut tempus eu, varius non diam.\r\n\r\nNam egestas consectetur sagittis. Maecenas eu purus nibh. Pellentesque fringilla neque eu dolor malesuada, non fermentum leo imperdiet. Vestibulum mollis, lacus et tempor posuere, risus libero ultrices ipsum, vitae mollis risus ipsum sed felis. Cras nec euismod eros, a consectetur tortor. Etiam bibendum aliquam metus ut faucibus. Sed pulvinar sollicitudin purus id scelerisque.', 'Ut gravida pellentesque mauris ut pretium. Nam pellentesque accumsan urna at porttitor. Curabitur mollis finibus lorem, vitae dictum nulla porttitor in. Integer id justo at sem tincidunt feugiat fermentum interdum enim. Vivamus ex neque, tempus sit amet bibendum sed, egestas eu est. In ullamcorper dictum felis, non viverra nisl rhoncus eu. Curabitur vel hendrerit nisl. Aenean vehicula consectetur libero porttitor fermentum. Etiam quis est semper, blandit orci a, fermentum ex. Nunc lacinia ex ut scelerisque sodales. Suspendisse congue varius orci sit amet lacinia. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nec magna a lacus eleifend accumsan.\r\n\r\nCras volutpat accumsan massa, blandit accumsan est suscipit sit amet. Nunc porta dignissim enim, aliquam ultricies odio sagittis vel. Quisque mollis est id molestie egestas. Cras facilisis eros risus, volutpat posuere felis placerat in. Pellentesque quis ipsum eu neque consequat gravida eget nec augue. Aenean in justo nulla. Integer ornare nisi eget mi dignissim, a tincidunt leo laoreet. Sed luctus ipsum at dui luctus suscipit ac id ligula. Curabitur egestas eleifend tellus, in mollis justo. Integer quis dolor condimentum, venenatis nisl eu, eleifend orci. Phasellus pulvinar, lorem nec ultricies suscipit, sem nisl tincidunt mauris, sed fringilla lorem ex finibus lacus. Maecenas nunc eros, euismod vitae euismod sed, fermentum aliquam magna. Aenean nec lectus maximus, fermentum nunc vel, laoreet ipsum.\r\nProin mollis aliquet purus, in lacinia nunc consequat ac. Suspendisse nisi lacus, faucibus nec tincidunt sollicitudin, molestie vitae odio. Vivamus facilisis tristique nisl, non tristique ex congue eget. Donec eget commodo elit, a sodales metus. Donec eu felis facilisis, vestibulum nunc sed, commodo lectus. Nulla aliquam maximus nunc sit amet bibendum. Donec mollis enim nec metus accumsan, scelerisque rutrum dui sagittis. Maecenas in lobortis turpis, quis pharetra odio. Donec ipsum nisi, interdum et sagittis vel, porttitor nec urna. In lacinia, massa et malesuada varius, enim diam auctor odio, dictum pellentesque dui mi eget lacus.', 3, '2021-07-08 19:06:40'),
(15, 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra, ligula ut posuere maximus, dui augue consequat felis, eget dictum enim odio ut nibh. Vivamus in tortor urna. Vestibulum vitae pretium nibh. Aenean placerat ex sem. Sed dictum commodo mollis. Nunc aliquet sagittis ex sed tempus. Mauris aliquam urna id bibendum viverra. Pellentesque finibus tristique fringilla. Suspendisse sem nulla, cursus ut tempus eu, varius non diam.\r\n\r\nNam egestas consectetur sagittis. Maecenas eu purus nibh. Pellentesque fringilla neque eu dolor malesuada, non fermentum leo imperdiet. Vestibulum mollis, lacus et tempor posuere, risus libero ultrices ipsum, vitae mollis risus ipsum sed felis. Cras nec euismod eros, a consectetur tortor. Etiam bibendum aliquam metus ut faucibus. Sed pulvinar sollicitudin purus id scelerisque.', 'Ut gravida pellentesque mauris ut pretium. Nam pellentesque accumsan urna at porttitor. Curabitur mollis finibus lorem, vitae dictum nulla porttitor in. Integer id justo at sem tincidunt feugiat fermentum interdum enim. Vivamus ex neque, tempus sit amet bibendum sed, egestas eu est. In ullamcorper dictum felis, non viverra nisl rhoncus eu. Curabitur vel hendrerit nisl. Aenean vehicula consectetur libero porttitor fermentum. Etiam quis est semper, blandit orci a, fermentum ex. Nunc lacinia ex ut scelerisque sodales. Suspendisse congue varius orci sit amet lacinia. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nec magna a lacus eleifend accumsan.\r\n\r\nCras volutpat accumsan massa, blandit accumsan est suscipit sit amet. Nunc porta dignissim enim, aliquam ultricies odio sagittis vel. Quisque mollis est id molestie egestas. Cras facilisis eros risus, volutpat posuere felis placerat in. Pellentesque quis ipsum eu neque consequat gravida eget nec augue. Aenean in justo nulla. Integer ornare nisi eget mi dignissim, a tincidunt leo laoreet. Sed luctus ipsum at dui luctus suscipit ac id ligula. Curabitur egestas eleifend tellus, in mollis justo. Integer quis dolor condimentum, venenatis nisl eu, eleifend orci. Phasellus pulvinar, lorem nec ultricies suscipit, sem nisl tincidunt mauris, sed fringilla lorem ex finibus lacus. Maecenas nunc eros, euismod vitae euismod sed, fermentum aliquam magna. Aenean nec lectus maximus, fermentum nunc vel, laoreet ipsum.\r\nProin mollis aliquet purus, in lacinia nunc consequat ac. Suspendisse nisi lacus, faucibus nec tincidunt sollicitudin, molestie vitae odio. Vivamus facilisis tristique nisl, non tristique ex congue eget. Donec eget commodo elit, a sodales metus. Donec eu felis facilisis, vestibulum nunc sed, commodo lectus. Nulla aliquam maximus nunc sit amet bibendum. Donec mollis enim nec metus accumsan, scelerisque rutrum dui sagittis. Maecenas in lobortis turpis, quis pharetra odio. Donec ipsum nisi, interdum et sagittis vel, porttitor nec urna. In lacinia, massa et malesuada varius, enim diam auctor odio, dictum pellentesque dui mi eget lacus.\r\nNam egestas consectetur sagittis. Maecenas eu purus nibh. Pellentesque fringilla neque eu dolor malesuada, non fermentum leo imperdiet. Vestibulum mollis, lacus et tempor posuere, risus libero ultrices ipsum, vitae mollis risus ipsum sed felis. Cras nec euismod eros, a consectetur tortor. Etiam bibendum aliquam metus ut faucibus. Sed pulvinar sollicitudin purus id scelerisque.', 3, '2021-07-08 19:07:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `creation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `email`, `role`, `creation_date`) VALUES
(3, 'Admin', '$2y$10$VUwE0xxTq9H1qohicXTi2eO5FRbjpHXe9A.xn21ti/E2ZNgvJX5ha', 'admin@gmail.com', 'admin', '2021-06-17'),
(33, 'paul', '$2y$10$FPshfMseH6Qnb2JZddEzMOaVSAdJd/aiDIvtQI9VYCpDBRFZZwRc.', 'paul@gmail.com', 'member', '2021-08-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `post_id` (`post_id`) USING BTREE,
  ADD KEY `author_comment` (`author_comment`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_post` (`author_post`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `author_comment_id` FOREIGN KEY (`author_comment`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author_post`) REFERENCES `users` (`id`) ON DELETE CASCADE;
