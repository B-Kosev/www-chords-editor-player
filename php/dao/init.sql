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

INSERT INTO `chords` (`id`, `name`, `first`, `third`, `fifth`, `inversion`) VALUES
('c', 'C Major', '2c', '2e', '2g', 1),
('c', 'C Major', '2e', '2g', '3c', 2),
('c', 'C Major', '1g', '2c', '2e', 3),
('cm', 'C Minor', '2c', '2ds', '2g', 1),
('cm', 'C Minor', '2ds', '2g', '3c', 2),
('cm', 'C Minor', '1g', '2c', '2ds', 3),

('cs', 'C# Major', '2cs', '2f', '2gs', 1),
('cs', 'C# Major', '2f', '2gs', '3cs', 2),
('cs', 'C# Major', '1gs', '2cs', '2f', 3),
('csm', 'C# Minor', '2cs', '2e', '2gs', 1),
('csm', 'C# Minor', '2e', '2gs', '3cs', 2),
('csm', 'C# Minor', '1gs', '2cs', '2e', 3),

('d', 'D Major', '2d', '2fs', '2a', 1),
('d', 'D Major', '2fs', '2a', '3d', 2),
('d', 'D Major', '1a', '2d', '2fs', 3),
('dm', 'D Minor', '2d', '2f', '2a', 1),
('dm', 'D Minor', '2f', '2a', '3d', 2),
('dm', 'D Minor', '1a', '2d', '2f', 3),

('ds', 'D# Major', '2ds', '2g', '2as', 1),
('ds', 'D# Major', '2g', '2as', '3ds', 2),
('ds', 'D# Major', '1as', '2ds', '2g', 3),
('dsm', 'D# Minor', '2ds', '2fs', '2as', 1),
('dsm', 'D# Minor', '2fs', '2as', '3ds', 2),
('dsm', 'D# Minor', '1as', '2ds', '2fs', 3),

('e', 'E Major', '2e', '2gs', '2b', 1),
('e', 'E Major', '1gs', '1b', '2e', 2),
('e', 'E Major', '1b', '2e', '2gs', 3),
('em', 'E Minor', '2e', '2g', '2b', 1),
('em', 'E Minor', '1g', '1b', '2e', 2),
('em', 'E Minor', '1b', '2e', '2g', 3),

('f', 'F Major', '2f', '2a', '3c', 1),
('f', 'F Major', '1a', '2c', '2f', 2),
('f', 'F Major', '2c', '2f', '2a', 3),
('fm', 'F Minor', '2f', '2gs', '3c', 1),
('fm', 'F Minor', '1gs', '2c', '2f', 2),
('fm', 'F Minor', '2c', '2f', '2gs', 3),

('fs', 'F# Major', '2fs', '2as', '3cs', 1),
('fs', 'F# Major', '1as', '2cs', '2fs', 2),
('fs', 'F# Major', '2cs', '2fs', '2as', 3),
('fsm', 'F# Minor', '2fs', '2a', '3cs', 1),
('fsm', 'F# Minor', '1a', '2cs', '2fs', 2),
('fsm', 'F# Minor', '2cs', '2fs', '2a', 3),

('g', 'G Major', '1g', '1b', '2d', 1),
('g', 'G Major', '1b', '2d', '2g', 2),
('g', 'G Major', '2d', '2g', '2b', 3),
('gm', 'G Minor', '1g', '1as', '2d', 1),
('gm', 'G Minor', '1as', '2d', '2g', 2),
('gm', 'G Minor', '2d', '2g', '2as', 3),

('gs', 'G# Major', '1gs', '2c', '2ds', 1),
('gs', 'G# Major', '2c', '2ds', '2gs', 2),
('gs', 'G# Major', '2ds', '2gs', '3c', 3),
('gsm', 'G# Minor', '1gs', '1b', '2ds', 1),
('gsm', 'G# Minor', '1b', '2ds', '2gs', 2),
('gsm', 'G# Minor', '2ds', '2gs', '2b', 3),

('a', 'A Major', '1a', '2cs', '2e', 1),
('a', 'A Major', '2cs', '2e', '2a', 2),
('a', 'A Major', '2e', '2a', '3cs', 3),
('am', 'A Minor', '1a', '2c', '2e', 1),
('am', 'A Minor', '2c', '2e', '2a', 2),
('am', 'A Minor', '2e', '2a', '3c', 3),

('as', 'A# Major', '1as', '2d', '2f', 1),
('as', 'A# Major', '2d', '2f', '2as', 2),
('as', 'A# Major', '2f', '2as', '3d', 3),
('asm', 'A# Minor', '1as', '2cs', '2f', 1),
('asm', 'A# Minor', '2cs', '2f', '2as', 2),
('asm', 'A# Minor', '2f', '2as', '3cs', 3),

('b', 'B Major', '1b', '2ds', '2fs', 1),
('b', 'B Major', '2ds', '2fs', '2b', 2),
('b', 'B Major', '2fs', '2b', '3ds', 3),
('bm', 'B Minor', '1b', '2d', '2fs', 1),
('bm', 'B Minor', '2d', '2fs', '2b', 2),
('bm', 'B Minor', '2fs', '2b', '3d', 3);

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
COMMIT;