<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('formatChatTimestamp')) {
    function formatChatTimestamp($timestamp) {
        // Convert the timestamp to a DateTime object
        $dateTime = new DateTime($timestamp);
        $now = new DateTime();

        // Calculate the difference between now and the timestamp
        $interval = $now->diff($dateTime);

        // Determine the time difference in various units
        if ($interval->y > 0) {
            return $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
        }
        if ($interval->m > 0) {
            return $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
        }
        if ($interval->d > 0) {
            return $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
        }
        if ($interval->h > 0) {
            return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
        }
        if ($interval->i > 0) {
            return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
        }
        if ($interval->s >= 0) {
            return 'just now';
        }

        // If the timestamp is from today, display the time
        if ($now->format('Y-m-d') === $dateTime->format('Y-m-d')) {
            return $dateTime->format('g:i A') . ' today';
        }

        // Fallback if the time is too old
        return 'long time ago';
    }

    function formatTimeLeft($secondsLeft) {
        // Calculate time intervals
        $years = floor($secondsLeft / (365 * 24 * 60 * 60)); // Number of years
        $months = floor(($secondsLeft % (365 * 24 * 60 * 60)) / (30 * 24 * 60 * 60)); // Number of months
        $days = floor(($secondsLeft % (30 * 24 * 60 * 60)) / (24 * 60 * 60)); // Number of days
        $hours = floor(($secondsLeft % (24 * 60 * 60)) / (60 * 60)); // Number of hours
        $minutes = floor(($secondsLeft % (60 * 60)) / 60); // Number of minutes
        $seconds = $secondsLeft % 60; // Number of seconds

        // Determine the time left in various units
         if ($years > 0) {
            $result = $years . ' year' . ($years > 1 ? 's' : '');
            if ($months > 0) {
                $result .= ' and ' . $months . ' month' . ($months > 1 ? 's' : '');
            }
            return $result . ' left';
        }
        if ($months > 0) {
            $result = $months . ' month' . ($months > 1 ? 's' : '');
            if ($days > 0) {
                $result .= ' and ' . $days . ' day' . ($days > 1 ? 's' : '');
            }
            return $result . ' left';
        }
        if ($days > 0) {
            return $days . ' day' . ($days > 1 ? 's' : '') . ' left';
        }
        if ($hours > 0) {
            return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' left';
        }
        if ($minutes > 0) {
            return $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' left';
        }
        if ($seconds >= 0) {
            return $seconds . ' second' . ($seconds > 1 ? 's' : '') . ' left';
        }

        // If no time is left, return this message
        return 'no time left';
    }

}
