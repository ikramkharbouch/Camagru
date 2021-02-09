<?php
    
include_once './database.php';


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    $conn = $db;

    // Create query
    $query = "DROP DATABASE `ikrkharb`";

    // Prepare statement
    $stmt = $db->prepare($query);

    // Execute query
    $stmt->execute();

    // Run multiple queries at a time

    $query = "CREATE DATABASE `ikrkharb`";

     // Prepare statement
     $stmt = $db->prepare($query);

     // Execute query
     $stmt->execute();

     // Create table account_sessions

    $query = "CREATE TABLE ikrkharb.account_sessions (
        `account_id` int(11) NOT NULL,
        `sess_id` varchar(100) NOT NULL,
        `login_time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

    // Prepare statement
    $stmt = $db->prepare($query);

    // Execute query
    $stmt->execute();


    // Create table posts

    $query = "CREATE TABLE ikrkharb.posts (
        `account_id` int(8) NOT NULL,
        `post_id` varchar(50) NOT NULL,
        `likes` int(255) NOT NULL,
        `comments` int(11) NOT NULL,
        `post` varchar(50) NOT NULL,
        `creation_date` date DEFAULT NULL,
        `creation_time` time NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

    // Prepare statement
    $stmt = $db->prepare($query);

    // Execute query
    $stmt->execute();


    // Create table users

    $query = "CREATE TABLE ikrkharb.users (
    `id` int(8) NOT NULL AUTO_INCREMENT,
    `fullname` varchar(50) NOT NULL,
    `email` varchar(50) NOT NULL,
    `username` varchar(50) NOT NULL,
    `pass` varchar(50) NOT NULL,
    `token` varchar(100) NOT NULL,
    `verified` tinyint(1) NOT NULL,
    `notifs` tinyint(1) NOT NULL,
    `profile_pic` varchar(255) NOT NULL,
    `private_token` varchar(50) NOT NULL,
    PRIMARY KEY (ID)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

    // Prepare statement
    $stmt = $db->prepare($query);

    // Execute query
    $stmt->execute();


    // Create table user_comments

    $query = "CREATE TABLE ikrkharb.user_comments (
        `comment_id` int(8) NOT NULL AUTO_INCREMENT,
        `account_id` int(8) NOT NULL,
        `post_id` varchar(50) NOT NULL,
        `commented` tinyint(1) NOT NULL,
        `comment` varchar(255) NOT NULL,
        PRIMARY KEY (comment_id)
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
      
          // Prepare statement
          $stmt = $db->prepare($query);
      
          // Execute query
          $stmt->execute();

    // Create table user_likes

    $query = "CREATE TABLE ikrkharb.user_likes (
        `account_id` int(8) NOT NULL,
        `post_id` varchar(50) NOT NULL,
        `liked` tinyint(1) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
      
          // Prepare statement
          $stmt = $db->prepare($query);
      
          // Execute query
          $stmt->execute();

    // Create table user_stats

    $query = "CREATE TABLE ikrkharb.user_stats (
        `account_id` int(8) NOT NULL,
        `likes` bigint(255) NOT NULL,
        `comments` bigint(255) NOT NULL,
        `liked_post` bigint(255) NOT NULL,
        `commented_post` varchar(50) NOT NULL,
        `comment_text` longtext NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
      
          // Prepare statement
          $stmt = $db->prepare($query);
      
          // Execute query
          $stmt->execute();

    // Alter table

    $query = "ALTER TABLE ikrkharb.account_sessions
    ADD PRIMARY KEY (`account_id`);";
      
          // Prepare statement
          $stmt = $db->prepare($query);
      
          // Execute query
          $stmt->execute();

?>