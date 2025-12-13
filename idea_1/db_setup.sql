CREATE TABLE users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  username TEXT,
  password TEXT,
  flag TEXT
);

-- Passwords stored using SHA-512 hashes for training purposes.
INSERT INTO users (username, password, flag) VALUES
('alice', 'ee4f2eaea4008af02cad5e5dabbe3964ce64d0e779cce15cc02850c390c25474a02399b49028394e6c8341171d7043a9b28ec1fdb0ae601288497fbfb5977222', 'FLAG{alex_should_parameterize}'),
('bob',   '4c3b39c97ca7b769be7d2846ac49048e65ea6fb6e69eb7850ebf2ba3e305f01a7075bebd291b16b2e2e82c73800255a7f2e8a809bc62147b24055929730a1f81', 'FLAG{bob_flag}'),
('charlie', '32bfdd0b7d12079b139193863ddc9960e8b919faaa29acda256b36e9fabff7263a419f63c8f627363c06e457fb49b4798fffa87057b094ec2a397798f1b6b306', 'FLAG{charlie_flag}');
