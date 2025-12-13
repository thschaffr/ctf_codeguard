CREATE TABLE users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  username TEXT,
  password TEXT,
  flag TEXT
);

-- Passwords stored using SHA-512 hashes.
INSERT INTO users (username, password, flag) VALUES
('alex', 'cdc16693300952420483b1825944d85ace67fe965617d88afa7fdab680572296d2b9170895efb2cb251f45304ddb91122c11a4bcfc4493362db1d7d61543cea2', 'FLAG{alex_should_parameterize}'),
('secret_user', 'DISABLED', 'FLAG{idor_for_the_win}'),
('bob', '4c3b39c97ca7b769be7d2846ac49048e65ea6fb6e69eb7850ebf2ba3e305f01a7075bebd291b16b2e2e82c73800255a7f2e8a809bc62147b24055929730a1f81', ''),
('charlie', '32bfdd0b7d12079b139193863ddc9960e8b919faaa29acda256b36e9fabff7263a419f63c8f627363c06e457fb49b4798fffa87057b094ec2a397798f1b6b306', '');
