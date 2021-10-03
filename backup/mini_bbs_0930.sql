-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-09-30 15:55:25
-- サーバのバージョン： 10.4.20-MariaDB
-- PHP のバージョン: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `mini_bbs`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `password`, `picture`, `created`, `modified`) VALUES
(2, 'moroto', '', '', 'images/CNO-THA.jpg', '2021-09-30 10:08:45', '2021-09-30 01:15:57'),
(3, 'yato', '', '', 'images/IMG_0254.JPG', '2021-09-30 10:12:26', '2021-09-30 01:16:27'),
(4, 'nomura', '', '', 'images/bangkok.jpg', '2021-09-30 10:13:05', '2021-09-30 01:16:36'),
(5, 'imai', '', '', 'images/IMG_0309.JPG', '2021-09-30 10:13:57', '2021-09-30 01:16:41'),
(6, 'yasuda', '', '', 'images/IMG_0276.JPG', '2021-09-30 10:14:06', '2021-09-30 01:16:49'),
(7, 'Mike', '', '', 'images/IMG_0864.JPG', '2021-09-30 10:14:15', '2021-09-30 01:17:12'),
(8, 'たけちゃん', '', '', 'images/IMG_0685.JPG', '2021-09-30 10:14:25', '2021-09-30 01:17:28');

-- --------------------------------------------------------

--
-- テーブルの構造 `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `member_id` int(11) NOT NULL,
  `reply_post_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `posts`
--

INSERT INTO `posts` (`id`, `message`, `member_id`, `reply_post_id`, `created`, `modified`) VALUES
(1, 'test', 0, 0, '0000-00-00 00:00:00', '2021-09-30 00:34:45'),
(2, 'test', 0, 0, '2021-09-30 09:36:35', '2021-09-30 00:36:35'),
(3, 'これはテストです。', 0, 0, '2021-09-30 09:36:57', '2021-09-30 00:36:57'),
(4, 'これはテストです。その２', 0, 0, '2021-09-30 09:50:04', '2021-09-30 00:50:04'),
(5, 'メモ５', 0, 0, '2021-09-30 10:11:10', '2021-09-30 01:11:10'),
(6, 'メモ６', 0, 0, '2021-09-30 10:11:16', '2021-09-30 01:11:16'),
(7, 'メモ７', 0, 0, '2021-09-30 10:11:25', '2021-09-30 01:11:25'),
(8, 'nsuavosafnb', 0, 0, '2021-09-30 11:12:18', '2021-09-30 02:12:18');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- テーブルの AUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
