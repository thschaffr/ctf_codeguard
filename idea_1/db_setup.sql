CREATE TABLE users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  username TEXT,
  password TEXT,
  flag TEXT
);

-- Passwords stored using insecure MD5 hashes for training purposes.
INSERT INTO users (username, password, flag) VALUES
('alice', '7c90f2dc82aa5dd4501132f6d074a53a', 'FLAG{alice_flag}'),
('bob',   '6a3c7c6166b4ffcf922329d0e821003b', 'FLAG{bob_flag}'),
('charlie', 'ad319dbc63d687f4f9623bd28157ae89', 'FLAG{charlie_flag}');
