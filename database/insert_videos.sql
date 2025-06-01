-- Insert viral videos into the database

-- Fails Category
INSERT INTO videos (title, source, video_id, category_id, status) VALUES
('Epic TikTok Fails Compilation 2024', 'youtube', 'FFi-AU09ZUY', (SELECT id FROM categories WHERE slug = 'fails'), 'active'),
('Best TikTok Fail Moments', 'tiktok', '7248957425478965', (SELECT id FROM categories WHERE slug = 'fails'), 'active'),
('Ultimate Fail Army Compilation', 'youtube', 'MuNzOjp33Fc', (SELECT id FROM categories WHERE slug = 'fails'), 'active');

-- Pranks Category
INSERT INTO videos (title, source, video_id, category_id, status) VALUES
('Hilarious TikTok Pranks 2024', 'tiktok', '7249857463214589', (SELECT id FROM categories WHERE slug = 'pranks'), 'active'),
('Best YouTube Pranks Compilation', 'youtube', 'ZwuiRV6yROc', (SELECT id FROM categories WHERE slug = 'pranks'), 'active'),
('Viral Prank Videos That Broke The Internet', 'youtube', 'k_dP2ZUldr0', (SELECT id FROM categories WHERE slug = 'pranks'), 'active');

-- Reactions Category
INSERT INTO videos (title, source, video_id, category_id, status) VALUES
('Best TikTok Reactions 2024', 'tiktok', '7250147852369541', (SELECT id FROM categories WHERE slug = 'reactions'), 'active'),
('Funniest Reaction Videos Ever', 'youtube', '67Y8XXF-beg', (SELECT id FROM categories WHERE slug = 'reactions'), 'active'),
('Viral Reactions That Made Everyone Laugh', 'youtube', 'MuNzOjp33Fc', (SELECT id FROM categories WHERE slug = 'reactions'), 'active');

-- WTF Category
INSERT INTO videos (title, source, video_id, category_id, status) VALUES
('Most Unexpected TikTok Moments', 'tiktok', '7251478963254147', (SELECT id FROM categories WHERE slug = 'wtf'), 'active'),
('WTF Moments That Break The Internet', 'youtube', 'FFi-AU09ZUY', (SELECT id FROM categories WHERE slug = 'wtf'), 'active'),
('Unbelievable Viral Videos 2024', 'youtube', 'ZwuiRV6yROc', (SELECT id FROM categories WHERE slug = 'wtf'), 'active');

-- Wins Category
INSERT INTO videos (title, source, video_id, category_id, status) VALUES
('Epic Win Compilation 2024', 'tiktok', '7252147896325417', (SELECT id FROM categories WHERE slug = 'wins'), 'active'),
('Most Satisfying Wins Ever', 'youtube', 'k_dP2ZUldr0', (SELECT id FROM categories WHERE slug = 'wins'), 'active'),
('Incredible TikTok Wins That Went Viral', 'youtube', '67Y8XXF-beg', (SELECT id FROM categories WHERE slug = 'wins'), 'active');

-- Add tags to videos
INSERT INTO video_tags (video_id, tag_id)
SELECT v.id, t.id
FROM videos v
CROSS JOIN tags t
WHERE t.slug IN ('lol', 'omg', 'new')
AND v.id IN (SELECT id FROM videos ORDER BY RAND() LIMIT 5);

-- Add 'featured' tag to some videos
INSERT INTO video_tags (video_id, tag_id)
SELECT v.id, t.id
FROM videos v
CROSS JOIN tags t
WHERE t.slug = 'featured'
AND v.id IN (SELECT id FROM videos ORDER BY RAND() LIMIT 3);
