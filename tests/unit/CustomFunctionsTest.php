<?php
/**
 * Custom Functions Test Cases
 * 
 * Tests for custom SQE project functions
 * These tests will show actual coverage in reports
 */

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CustomFunctionsTest extends TestCase
{
    /**
     * Test custom user creation function
     */
    public function test_sqe_create_user()
    {
        $username = 'sqe_test_user_' . time();
        $email = 'sqe_test_' . time() . '@example.com';
        $password = 'TestPassword123!';
        
        if (function_exists('sqe_create_user')) {
            $user_id = \sqe_create_user($username, $email, $password);
            
            $this->assertIsInt($user_id, 'User ID should be an integer');
            $this->assertGreaterThan(0, $user_id, 'User ID should be greater than 0');
            
            // Clean up
            if ($user_id > 0) {
                \wp_delete_user($user_id);
            }
        } else {
            $this->markTestSkipped('sqe_create_user function not available');
        }
    }
    
    /**
     * Test custom post creation function
     */
    public function test_sqe_create_post()
    {
        if (function_exists('sqe_create_post')) {
            $title = 'Test Post ' . time();
            $content = 'This is test content for coverage';
            $status = 'publish';
            
            $post_id = \sqe_create_post($title, $content, $status);
            
            $this->assertIsInt($post_id, 'Post ID should be an integer');
            $this->assertGreaterThan(0, $post_id, 'Post ID should be greater than 0');
            
            // Verify post was created
            $post = \get_post($post_id);
            $this->assertNotNull($post, 'Post should exist');
            $this->assertEquals($title, $post->post_title, 'Post title should match');
            
            // Clean up
            \wp_delete_post($post_id, true);
        } else {
            $this->markTestSkipped('sqe_create_post function not available');
        }
    }
    
    /**
     * Test custom authentication function
     */
    public function test_sqe_authenticate_user()
    {
        if (function_exists('sqe_authenticate_user')) {
            // Create a test user first
            $username = 'sqe_auth_test_' . time();
            $email = 'sqe_auth_' . time() . '@example.com';
            $password = 'AuthTest123!';
            
            $user_id = \wp_create_user($username, $password, $email);
            
            if (!\is_wp_error($user_id)) {
                $user = \sqe_authenticate_user($username, $password);
                
                $this->assertInstanceOf(\WP_User::class, $user, 'Should return WP_User object');
                $this->assertEquals($username, $user->user_login, 'Username should match');
                
                // Clean up
                \wp_delete_user($user_id);
            } else {
                $this->markTestSkipped('Failed to create test user');
            }
        } else {
            $this->markTestSkipped('sqe_authenticate_user function not available');
        }
    }
    
    /**
     * Test get user posts count function
     */
    public function test_sqe_get_user_posts_count()
    {
        if (function_exists('sqe_get_user_posts_count')) {
            // Create a test user
            $username = 'sqe_posts_test_' . time();
            $email = 'sqe_posts_' . time() . '@example.com';
            $password = 'PostsTest123!';
            
            $user_id = \wp_create_user($username, $password, $email);
            
            if (!\is_wp_error($user_id)) {
                // Create some posts for this user
                \wp_set_current_user($user_id);
                
                $post1_id = \wp_insert_post(array(
                    'post_title' => 'Test Post 1',
                    'post_content' => 'Content 1',
                    'post_status' => 'publish',
                    'post_author' => $user_id,
                ));
                
                $post2_id = \wp_insert_post(array(
                    'post_title' => 'Test Post 2',
                    'post_content' => 'Content 2',
                    'post_status' => 'publish',
                    'post_author' => $user_id,
                ));
                
                $count = \sqe_get_user_posts_count($user_id);
                
                $this->assertIsInt($count, 'Count should be an integer');
                $this->assertGreaterThanOrEqual(2, $count, 'Should have at least 2 posts');
                
                // Clean up
                \wp_delete_post($post1_id, true);
                \wp_delete_post($post2_id, true);
                \wp_delete_user($user_id);
            } else {
                $this->markTestSkipped('Failed to create test user');
            }
        } else {
            $this->markTestSkipped('sqe_get_user_posts_count function not available');
        }
    }
    
    /**
     * Test validate post data function
     */
    public function test_sqe_validate_post_data()
    {
        if (function_exists('sqe_validate_post_data')) {
            // Test valid data
            $valid_data = array(
                'post_title' => 'Valid Post',
                'post_status' => 'publish',
            );
            
            $result = \sqe_validate_post_data($valid_data);
            $this->assertTrue($result, 'Valid data should return true');
            
            // Test invalid data (missing title)
            $invalid_data = array(
                'post_status' => 'publish',
            );
            
            $result = \sqe_validate_post_data($invalid_data);
            $this->assertInstanceOf(\WP_Error::class, $result, 'Invalid data should return WP_Error');
            
            // Test invalid status
            $invalid_status = array(
                'post_title' => 'Test',
                'post_status' => 'invalid_status',
            );
            
            $result = \sqe_validate_post_data($invalid_status);
            $this->assertInstanceOf(\WP_Error::class, $result, 'Invalid status should return WP_Error');
        } else {
            $this->markTestSkipped('sqe_validate_post_data function not available');
        }
    }
}

