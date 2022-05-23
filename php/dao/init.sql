SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `chordsplayereditor` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `chordsplayereditor`;

CREATE TABLE IF NOT EXISTS `chords` (
  `key` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `first` varchar(3) NOT NULL,
  `third` varchar(3) NOT NULL,
  `fifth` varchar(3) NOT NULL,
  `inversion` int(10) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `songs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `key` varchar(3) NOT NULL,
  `year` int(10) NOT NULL,
  `text` varchar(2500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO `chords` (`id`, `name`, `first`, `third`, `fifth`, `inversion`) VALUES
('c', 'C Major', 'c2', 'e2', 'g2', 1),
('c', 'C Major', 'e2', 'g2', 'c3', 2),
('c', 'C Major', 'g1', 'c2', 'e2', 3),
('cm', 'C Minor', 'c2', 'ds2', 'g2', 1),
('cm', 'C Minor', 'ds2', 'g2', 'c3', 2),
('cm', 'C Minor', 'g1', 'c2', 'ds2', 3),

('cs', 'C# Major', 'cs2', 'f2', 'gs2', 1),
('cs', 'C# Major', 'f2', 'gs2', 'cs3', 2),
('cs', 'C# Major', 'gs1', 'cs2', 'f2', 3),
('csm', 'C# Minor', 'cs2', 'e2', 'gs2', 1),
('csm', 'C# Minor', 'e2', 'gs2', 'cs3', 2),
('csm', 'C# Minor', 'gs1', 'cs2', 'e2', 3),

('d', 'D Major', 'd2', 'fs2', 'a2', 1),
('d', 'D Major', 'fs2', 'a2', 'd3', 2),
('d', 'D Major', 'a1', 'd2', 'fs2', 3),
('dm', 'D Minor', 'd2', 'f2', 'a2', 1),
('dm', 'D Minor', 'f2', 'a2', 'd3', 2),
('dm', 'D Minor', 'a1', 'd2', 'f2', 3),

('ds', 'D# Major', 'ds2', 'g2', 'as2', 1),
('ds', 'D# Major', 'g2', 'as2', 'ds3', 2),
('ds', 'D# Major', 'as1', 'ds2', 'g2', 3),
('dsm', 'D# Minor', 'ds2', 'fs2', 'as2', 1),
('dsm', 'D# Minor', 'fs2', 'as2', 'ds3', 2),
('dsm', 'D# Minor', 'as1', 'ds2', 'fs2', 3),

('e', 'E Major', 'e2', 'gs2', 'b2', 1),
('e', 'E Major', 'gs1', 'b1', 'e2', 2),
('e', 'E Major', 'b1', 'e2', 'gs2', 3),
('em', 'E Minor', 'e2', 'g2', 'b2', 1),
('em', 'E Minor', 'g1', 'b1', 'e2', 2),
('em', 'E Minor', 'b1', 'e2', 'g2', 3),

('f', 'F Major', 'f2', 'a2', 'c3', 1),
('f', 'F Major', 'a1', 'c2', 'f2', 2),
('f', 'F Major', 'c2', 'f2', 'a2', 3),
('fm', 'F Minor', 'f2', 'gs2', 'c3', 1),
('fm', 'F Minor', 'gs1', 'c2', 'f2', 2),
('fm', 'F Minor', 'c2', 'f2', 'gs2', 3),

('fs', 'F# Major', 'fs2', 'as2', 'cs3', 1),
('fs', 'F# Major', 'as1', 'cs2', 'fs2', 2),
('fs', 'F# Major', 'cs2', 'fs2', 'as2', 3),
('fsm', 'F# Minor', 'fs2', 'a2', 'cs3', 1),
('fsm', 'F# Minor', 'a1', 'cs2', 'fs2', 2),
('fsm', 'F# Minor', 'cs2', 'fs2', 'a2', 3),

('g', 'G Major', 'g1', 'b1', 'd2', 1),
('g', 'G Major', 'b1', 'd2', 'g2', 2),
('g', 'G Major', 'd2', 'g2', 'b2', 3),
('gm', 'G Minor', 'g1', 'as1', 'd2', 1),
('gm', 'G Minor', 'as1', 'd2', 'g2', 2),
('gm', 'G Minor', 'd2', 'g2', 'as2', 3),

('gs', 'G# Major', 'gs1', 'c2', 'ds2', 1),
('gs', 'G# Major', 'c2', 'ds2', 'gs2', 2),
('gs', 'G# Major', 'ds2', 'gs2', 'c3', 3),
('gsm', 'G# Minor', 'gs1', 'b1', 'ds2', 1),
('gsm', 'G# Minor', 'b1', 'ds2', 'gs2', 2),
('gsm', 'G# Minor', 'ds2', 'gs2', 'b2', 3),

('a', 'A Major', 'a1', 'cs2', 'e2', 1),
('a', 'A Major', 'cs2', 'e2', 'a2', 2),
('a', 'A Major', 'e2', 'a2', 'cs3', 3),
('am', 'A Minor', 'a1', 'c2', 'e2', 1),
('am', 'A Minor', 'c2', 'e2', 'a2', 2),
('am', 'A Minor', 'e2', 'a2', 'c3', 3),

('as', 'A# Major', 'as1', 'd2', 'f2', 1),
('as', 'A# Major', 'd2', 'f2', 'as2', 2),
('as', 'A# Major', 'f2', 'as2', 'd3', 3),
('asm', 'A# Minor', 'as1', 'cs2', 'f2', 1),
('asm', 'A# Minor', 'cs2', 'f2', 'as2', 2),
('asm', 'A# Minor', 'f2', 'as2', 'cs3', 3),

('b', 'B Major', 'b1', 'ds2', 'fs2', 1),
('b', 'B Major', 'ds2', 'fs2', 'b2', 2),
('b', 'B Major', 'fs2', 'b2', 'ds3', 3),
('bm', 'B Minor', 'b1', 'd2', 'fs2', 1),
('bm', 'B Minor', 'd2', 'fs2', 'b2', 2),
('bm', 'B Minor', 'fs2', 'b2', 'd3', 3);

INSERT INTO `songs` (`title`, `author`, `key`, `year`, `text`) VALUES
('Amazing Grace', 'John Newton', 'E', '1772',
'Verse 1
Am[E]azing Grace how sw[A]eet the s[E]ound,
That s[C#m]aved a wretch l[B]ike me!
I [E]once was lost, but n[A]ow am f[E]ound;
Was bl[C#m]ind, but n[B]ow I s[E]ee.

Verse 2
‘Twas gr[E]ace that taught my h[A]eart to f[E]ear,
And gr[C#m]ace my fears rel[B]ieved;
How pr[E]ecious did that gr[A]ace app[E]ear
The h[C#m]our I f[B]irst bel[E]ieved!

Verse 3
Through m[E]any dangers, t[A]oils and sn[E]ares,
I h[C#m]ave already c[B]ome;
‘Tis gr[E]ace hath brought me s[A]afe thus f[E]ar,
And gr[C#m]ace will l[B]ead me h[E]ome.

Verse 4
The L[E]ord has promised g[A]ood to me,
His W[C#m]ord my hope sec[B]ures;
He w[E]ill my Shield and P[A]ortion [E]be,
As l[C#m]ong as l[B]ife end[E]ures.

Verse 5
Yea, wh[E]en this flesh and h[A]eart shall f[E]ail,
And m[C#m]ortal life shall c[B]ease,
I sh[E]all possess, with[A]in the v[E]eil,
A l[C#m]ife of j[B]oy and p[E]eace.

Verse 6
The [E]earth shall soon diss[A]olve like sn[E]ow,
The s[C#m]un forbear to sh[B]ine;
But G[E]od, Who called me h[A]ere bel[E]ow,
Will [C#m]be for[B]ever m[E]ine.

Verse 7
When [E]we’ve been there ten th[A]ousand y[E]ears,
Bright sh[C#m]ining as the s[B]un,
We’ve [E]no less days to s[A]ing God’s pr[E]aise
Than wh[C#m]en we’d f[B]irst beg[E]un.');

INSERT INTO `users`(`username`,`email`,`password`) VALUES
('admin','admin@example.com','d033e22ae348aeb5660fc2140aec35850c4da997');
COMMIT;