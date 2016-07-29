-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 29, 2016 at 09:31 AM
-- Server version: 10.0.22-MariaDB
-- PHP Version: 7.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `reporting_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `current_version_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `priority` enum('High','Low') NOT NULL DEFAULT 'Low',
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reports_request`
--

CREATE TABLE `reports_request` (
  `id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `version_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `priority` enum('High','Low') NOT NULL DEFAULT 'Low',
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports_request`
--
ALTER TABLE `reports_request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reports_request`
--
ALTER TABLE `reports_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
