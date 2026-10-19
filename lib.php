<?php
/* ===== AUTOMIGZ — shared helpers (session, database, car data) ===== */
declare(strict_types=1);

require_once __DIR__ . '/config.php';

date_default_timezone_set('Asia/Manila');

/* Set to false before going online: shows the real error text on the page while true. */
const DEBUG = true;

const DELIVERY_FEE = 500;
const LOCATIONS = [
    "Automigz Main Office — Cabanatuan City",
];

/* Single source of truth for cars: the server uses these prices, so customers can't change them. */
function cars(): array {
    return [
        //SUV CARS
        ['id'=>1,'name'=>'Toyota Fortuner','type'=>'SUV','price'=>4500,'trans'=>'Automatic Transmission','img'=>'images/img1.png',
         'info'=>'7-seater SUV · 2.8L Diesel · 201 HP · Perfect for family trips',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Attitude Black','h'=>'#1c1c1e'],['n'=>'Red Mica','h'=>'#a11212']]],
        ['id'=>2,'name'=>'Nissan Terra','type'=>'SUV','price'=>8000,'trans'=>'Automatic Transmission','img'=>'images/Nissan Terra.png',
         'info'=>'7-seater SUV · 2.8L Diesel · 201 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>3,'name'=>'Mitsubishi Montero','type'=>'SUV','price'=>8000,'trans'=>'Automatic Transmission','img'=>'images/Mitsubishi Montero.png',
         'info'=>'7-seater SUV · 2.8L Diesel · 201 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>4,'name'=>'Isuzu MUX','type'=>'SUV','price'=>8000,'trans'=>'Automatic Transmission','img'=>'images/Isuzu MUX.png',
         'info'=>'7-seater SUV · 2.8L Diesel · 201 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>5,'name'=>'Ford Everest','type'=>'SUV','price'=>8000,'trans'=>'Automatic Transmission','img'=>'images/Ford Everest.png', 
         'info'=>'7-seater SUV · 2.8L Diesel · 201 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],

        //PICK-UP CARS
         ['id'=>6,'name'=>'Toyota Hilux','type'=>'Pick-up','price'=>3500,'trans'=>'Automatic Transmission','img'=>'images/Pick up1.png',
         'info'=>'4x4 pick-up · 2.8L Diesel · 201 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>7,'name'=>'Ford Ranger','type'=>'Pick-up','price'=>4000,'trans'=>'Automatic Transmission','img'=>'images/Pick up.png',
         'info'=>'4x4 pick-up · 2.0L Diesel · 168 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>8,'name'=>'Nissan Navarra','type'=>'Pick-up','price'=>3000,'trans'=>'Automatic Transmission','img'=>'images/Pick up-N.Navara.png',
         'info'=>'4x4 pick-up · 2.5L Diesel · 187 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>9,'name'=>'Mitsubishi Triton','type'=>'Pick-up','price'=>3500,'trans'=>'Automatic Transmission','img'=>'images/Pick up-T.Triton.png',
         'info'=>'4x4 pick-up · 2.4L Diesel · 178 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>10,'name'=>'Isuzu D-Max','type'=>'Pick-up','price'=>3000,'trans'=>'Automatic Transmission','img'=>'images/Isuzu D-Max.png',
         'info'=>'4x4 pick-up · 3.0L Diesel · 187 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],

        //VAN CARS
         ['id'=>11,'name'=>'Toyota HiAce Commuter','type'=>'Van','price'=>4500,'trans'=>'Automatic Transmission','img'=>'images/van2-T.Grand.png',
         'info'=>'4x4 pick-up · 2.8L Diesel · 174 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>12,'name'=>'Nissan NV350 Urvan','type'=>'Van','price'=>4500,'trans'=>'Automatic Transmission','img'=>'images/Nissan NV350 Urvan.png',
         'info'=>'4x4 pick-up · 2.5L Diesel · 127 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>13,'name'=>'Toyota HiAce Grandia','type'=>'Van','price'=>5500,'trans'=>'Automatic Transmission','img'=>'images/Van.png',
         'info'=>'4x4 pick-up · 2.8L Diesel · 174 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>14,'name'=>'Hyundai Staria','type'=>'Van','price'=>5000,'trans'=>'Automatic Transmission','img'=>'images/Hyundai Staria.png',
         'info'=>'4x4 pick-up · 2.2L Diesel · 175 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>15,'name'=>'Hyundai Grand Starex','type'=>'Van','price'=>4000,'trans'=>'Automatic Transmission','img'=>'images/Hyundai Grand Starex.png',
         'info'=>'4x4 pick-up · 2.5L Diesel · 168 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],

        //SEDAN CARS
         ['id'=>16,'name'=>'Toyota Vios','type'=>'Sedan','price'=>1500,'trans'=>'Automatic Transmission','img'=>'images/sedan2.png',
         'info'=>'Daily Use Sedan · 1.5L Gasoline · 106 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>17,'name'=>'Honda City','type'=>'Sedan','price'=>2000,'trans'=>'Automatic Transmission','img'=>'images/sedan1.png',
         'info'=>'Daily Use Sedan · 1.5L Gasoline · 119 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>18,'name'=>'Mitsubishi Mirage G4','type'=>'Sedan','price'=>1500,'trans'=>'Automatic Transmission','img'=>'images/sedan3.png',
         'info'=>'Daily Use Sedan · 1.2L Gasoline · 78 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>19,'name'=>'Toyota Corolla Altis','type'=>'Sedan','price'=>2500,'trans'=>'Automatic Transmission','img'=>'images/sedan4.png',
         'info'=>'Daily Use Sedan · 1.8L Gasoline · 138 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>20,'name'=>'Nissan Almera','type'=>'Sedan','price'=>1800,'trans'=>'Automatic Transmission','img'=>'images/sedan.png',
         'info'=>'Daily Use Sedan · 1.0L Gasoline · 99 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],

        //MPV CARS 
         ['id'=>21,'name'=>'Toyota Innova','type'=>'MPV','price'=>3000,'trans'=>'Automatic Transmission','img'=>'images/Toyota Innova.png',
         'info'=>'7 seater MPV · 2.8L Diesel · 171 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>22,'name'=>'Mitsubishi Xpander','type'=>'MPV','price'=>2500,'trans'=>'Automatic Transmission','img'=>'images/Mitsubishi XPANDER.png',
         'info'=>'7 seater MPV · 1.5L Gasoline · 103 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>23,'name'=>'Toyota Avanza','type'=>'MPV','price'=>2000,'trans'=>'Automatic Transmission','img'=>'images/Toyota Avanza.png',
         'info'=>'7 seater MPV · 1.5L Gasoline · 105 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>24,'name'=>'Toyota Rush','type'=>'MPV','price'=>2500,'trans'=>'Automatic Transmission','img'=>'images/Toyota Rush.png',
         'info'=>'7 seater MPV · 1.5L Gasoline · 101 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>25,'name'=>'Suzuki Ertiga','type'=>'MPV','price'=>2000,'trans'=>'Automatic Transmission','img'=>'images/Suzuki Ertiga.png',
         'info'=>'7 seater MPV · 1.5L Gasoline · 103 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],

        //ELECTRIC CARS
         ['id'=>26,'name'=>'BYD Dolphin','type'=>'Electric','price'=>8000,'trans'=>'Automatic Transmission','img'=>'images/BYD Dolphin.png',
         'info'=>'EV Car· N/A - Electric · 94-201 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>27,'name'=>'BYD Atto 3','type'=>'Electric','price'=>8000,'trans'=>'Automatic Transmission','img'=>'images/BYD Atto 3.png',
         'info'=>'EV Car· N/A - Electric · 201 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>28,'name'=>'MG4 EV','type'=>'Electric','price'=>8000,'trans'=>'Automatic Transmission','img'=>'images/MG4_EV.png',
         'info'=>'EV Car· N/A - Electric · 168-241 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>29,'name'=>'Tesla Model 3','type'=>'Electric','price'=>8000,'trans'=>'Automatic Transmission','img'=>'images/Tesla Model 3.png',
         'info'=>'EV Car· N/A - Electric · 260-510 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>30,'name'=>'BYD Seal','type'=>'Electric','price'=>8000,'trans'=>'Automatic Transmission','img'=>'images/BYD Seal.png',
         'info'=>'EV Car· N/A - Electric · 201-523 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],

        //LUXURY CARS
         ['id'=>31,'name'=>'Ford Mustang GT','type'=>'Luxury','price'=>12000,'trans'=>'Automatic Transmission','img'=>'images/Ford Mustang GT.png',
         'info'=>'4x4 pick-up · 5.0L Gasoline · 480 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>32,'name'=>'BMW 330i','type'=>'Luxury','price'=>10000,'trans'=>'Automatic Transmission','img'=>'images/BMW 330i.png',
         'info'=>'4x4 pick-up · 2.0L Gasoline · 255 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>33,'name'=>'Mercedes-Benz C-Class','type'=>'Luxury','price'=>12000,'trans'=>'Automatic Transmission','img'=>'images/Mercedes Benz C-Class.png',
         'info'=>'4x4 pick-up · 2.0L Gasoline · 255 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>34,'name'=>'Toyota GR Supra','type'=>'Luxury','price'=>15000,'trans'=>'Automatic Transmission','img'=>'images/Toyota GR Supra.png',
         'info'=>'4x4 pick-up · 3.0L Gasoline · 382 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],
         ['id'=>35,'name'=>'Porsche 911','type'=>'Luxury','price'=>25000,'trans'=>'Automatic Transmission','img'=>'images/Porsche 911.png',
         'info'=>'4x4 pick-up · 3.0L Gasoline · 388 HP · Built for heavy duty',
         'colors'=>[['n'=>'Super White','h'=>'#f4f4f4'],['n'=>'Silver Metallic','h'=>'#c0c0c8'],['n'=>'Black','h'=>'#191a1c'],['n'=>'Orange Metallic','h'=>'#d9622b']]],




























    ];
}

function start_session(): void {
    if (session_status() === PHP_SESSION_ACTIVE) return;
    ini_set('session.gc_maxlifetime', (string)(30 * 86400));
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'httponly' => true,
        'samesite' => 'Lax',
        'secure'   => !empty($_SERVER['HTTPS']),
    ]);
    session_start();
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));
}

/* MySQL database (phpMyAdmin) — database and tables are created automatically on first use */
function db(): PDO {
    static $pdo = null;
    if ($pdo) return $pdo;

    if (!extension_loaded('pdo_mysql')) {
        throw new RuntimeException('PHP extension pdo_mysql is not enabled. In php.ini remove the ; before extension=pdo_mysql, then restart Apache.');
    }
    $opts = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $base = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';charset=utf8mb4';

    try {
        try {
            $pdo = new PDO($base . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $opts);
        } catch (PDOException $e) {
            $code = (int)($e->errorInfo[1] ?? $e->getCode());
            if ($code !== 1049) throw $e;             // 1049 = database doesn't exist yet
            $tmp = new PDO($base, DB_USER, DB_PASS, $opts);
            $tmp->exec('CREATE DATABASE IF NOT EXISTS `' . DB_NAME . '` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
            $pdo = new PDO($base . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $opts);
        }
    } catch (PDOException $e) {
        $code = (int)($e->errorInfo[1] ?? $e->getCode());
        if ($code === 2002 || $code === 2006) {
            throw new RuntimeException('Cannot connect to MySQL. Open the XAMPP Control Panel and click Start next to MySQL.');
        }
        if ($code === 1045) {
            throw new RuntimeException('MySQL refused the username/password. Check DB_USER and DB_PASS in config.php.');
        }
        throw $e;
    }

    // create tables the first time
    if (!$pdo->query("SHOW TABLES LIKE 'bookings'")->fetch()) {
        $pdo->exec("CREATE TABLE IF NOT EXISTS users (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(60) NOT NULL,
            last_name VARCHAR(60) NOT NULL,
            mobile VARCHAR(20) NOT NULL,
            email VARCHAR(120) NOT NULL UNIQUE,
            pass_hash VARCHAR(255) NOT NULL,
            created_at VARCHAR(24) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
        $pdo->exec("CREATE TABLE IF NOT EXISTS bookings (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_id INT UNSIGNED NOT NULL,
            car_id INT NOT NULL,
            car_name VARCHAR(100) NOT NULL,
            img VARCHAR(255) NOT NULL,
            price INT NOT NULL,
            color_name VARCHAR(60) NOT NULL,
            color_hex VARCHAR(10) NOT NULL,
            days INT NOT NULL,
            qty INT NOT NULL,
            base INT NOT NULL,
            fee INT NOT NULL,
            total INT NOT NULL,
            mode VARCHAR(10) NOT NULL,
            location VARCHAR(120) NOT NULL,
            address VARCHAR(200) NOT NULL DEFAULT '',
            renter VARCHAR(100) NOT NULL,
            phone VARCHAR(20) NOT NULL,
            pick_date VARCHAR(10) NOT NULL,
            ret_date VARCHAR(10) NOT NULL,
            status VARCHAR(12) NOT NULL DEFAULT 'active',
            created_at VARCHAR(24) NOT NULL,
            cancelled_at VARCHAR(24) NULL,
            INDEX idx_user (user_id),
            CONSTRAINT fk_booking_user FOREIGN KEY (user_id) REFERENCES users(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    }
    return $pdo;
}

function current_user(): ?array {
    if (empty($_SESSION['uid'])) return null;
    $st = db()->prepare('SELECT id, first_name AS first, last_name AS last, mobile, email FROM users WHERE id = ?');
    $st->execute([$_SESSION['uid']]);
    $u = $st->fetch();
    return $u ?: null;
}

/* The shape app.js expects */
function public_user(?array $u): ?array {
    return $u ? ['first'=>$u['first'], 'last'=>$u['last'], 'mobile'=>$u['mobile'], 'email'=>$u['email']] : null;
}

function format_booking(array $r): array {
    return [
        'id'       => (int)$r['id'],
        'car'      => $r['car_name'],
        'img'      => $r['img'],
        'price'    => (int)$r['price'],
        'color'    => ['n'=>$r['color_name'], 'h'=>$r['color_hex']],
        'days'     => (int)$r['days'],
        'qty'      => (int)$r['qty'],
        'base'     => (int)$r['base'],
        'fee'      => (int)$r['fee'],
        'total'    => (int)$r['total'],
        'mode'     => $r['mode'],
        'location' => $r['location'],
        'address'  => $r['address'],
        'renter'   => $r['renter'],
        'phone'    => $r['phone'],
        'pickDate' => $r['pick_date'],
        'retDate'  => $r['ret_date'],
        'status'   => $r['status'],
        'date'     => $r['created_at'],
    ];
}
