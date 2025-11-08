CREATE TABLE users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  username TEXT,
  password TEXT,
  flag TEXT
);

INSERT INTO users (username, password, flag) VALUES
('alice', 'alicepass', 'FLAG{alice_flag}'),
('bob',   'bobpass',   'FLAG{bob_flag}');
