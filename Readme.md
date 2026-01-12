📦 PHP + MySQLi Verkkokauppa
Moderni, modulaarinen ja laajennettava verkkokauppa, rakennettu PHP:llä ja MySQLi:llä. Sisältää tuotteet, ostoskorin, kassatoiminnon, tilausten hallinnan ja täyden admin‑paneelin.
🚀 Ominaisuudet
🛍️ Frontend
    • Tuotelistaus
    • Tuotesivut
    • Ostoskori (session‑pohjainen)
    • Kassasivu
    • Tilausten tallennus tietokantaan
    • Varaston automaattinen vähennys
    • Hakutoiminto
    • Kategoriat
🔧 Backend / Admin
    • Dashboard (tilastot)
    • Tuotteiden hallinta (CRUD)
    • Kategorioiden hallinta
    • Tilausten hallinta
    • Tilauksen status (Pending → Completed)
    • Laskun tulostus
    • Admin‑käyttäjien hallinta (CRUD)
    • SHA‑256 salasanahashaus
🧱 Teknologiat
Osa	Teknologia
Backend	PHP 8.x (MySQLi)
Tietokanta	MySQL / MariaDB
Frontend	HTML5, CSS3
Palvelin	Apache / XAMPP
Sessiohallinta	PHP Sessions
Tietoturva	SHA‑256 salasanahashaus
📁 Hakemistorakenne
Koodi
verkkokauppa/
│
├── admin/
│   ├── index.php
│   ├── products.php
│   ├── add_product.php
│   ├── edit_product.php
│   ├── orders.php
│   ├── order_view.php
│   ├── order_invoice.php
│   ├── order_delete.php
│   ├── admin_users.php
│   ├── admin_users_add.php
│   ├── admin_users_delete.php
│   ├── admin_header.php
│   ├── admin_footer.php
│
├── images/
│
├── style.css
├── db.php
├── functions.php
├── index.php
├── product.php
├── cart.php
├── checkout.php
├── search.php
└── categories.php
🗄️ Tietokantarakenne
products
Koodi
id INT PK
name VARCHAR
description TEXT
price DECIMAL
stock INT
category_id INT
image VARCHAR
categories
Koodi
id INT PK
name VARCHAR
orders
Koodi
id INT PK
customer_name VARCHAR
address VARCHAR
postal_code VARCHAR
city VARCHAR
email VARCHAR
phone VARCHAR
total DECIMAL
status VARCHAR DEFAULT 'Pending'
created_at DATETIME DEFAULT CURRENT_TIMESTAMP
order_items
Koodi
id INT PK
order_id INT
product_id INT
quantity INT
price DECIMAL
admin_users
Koodi
id INT PK
username VARCHAR UNIQUE
password VARCHAR (SHA‑256 hash)
created_at DATETIME DEFAULT CURRENT_TIMESTAMP
🔧 Backend‑logiikka
db.php
    • Luo MySQLi‑yhteyden $conn
    • Asettaa UTF‑8‑merkistön
functions.php
Sisältää:
    • get_products()
    • get_product()
    • cart_add(), cart_remove(), cart_clear()
    • cart_total()
    • save_order()
    • admin_login()
Ostoskori
    • Tallennetaan sessioon
    • Tuotteet haetaan reaaliaikaisesti
    • Varasto vähenee tilauksen yhteydessä
Tilausten tallennus
    • Tallentaa asiakkaan tiedot
    • Lisää tilausrivit
    • Vähentää varaston
🖥️ Admin‑paneeli
Dashboard
    • Tuotteiden määrä
    • Tilausten määrä
    • Admin‑käyttäjien määrä
Tuotteet
    • Listaus
    • Lisääminen
    • Muokkaus
    • Poistaminen
    • Varaston hallinta
    • Kuvien lataus
Kategoriat
    • Listaus
    • Lisääminen
    • Poistaminen
Tilaukset
    • Listaus
    • Tilauksen tarkastelu
    • Status (Pending → Completed)
    • Laskun tulostus
    • Poistaminen
Admin‑käyttäjät
    • Listaus
    • Lisääminen
    • Poistaminen
    • SHA‑256 salasanahashaus
🔐 Tietoturva
    • SHA‑256 salasanahashaus
    • SQL‑injektiot estetty prepared statements ‑kutsuilla
    • Sessiohallinta
    • Admin‑paneeli erillään frontendistä
    • Ei paljasteta tietokantavirheitä käyttäjälle
📜 Kehityshistoria
    1. Perusrakenne luotu
    2. Tuotelistaus ja tuotesivu
    3. Ostoskori ja checkout
    4. Tilausten tallennus
    5. Admin‑paneeli
    6. Tuotteiden hallinta
    7. Tilausten hallinta
    8. Admin‑käyttäjähallinta
    9. PDO → MySQLi yhtenäistys
    10. Virheiden korjaus ja tietokantarakenteen yhtenäistäminen
🧭 Roadmap
Phase 1 — Core (valmis)
    • Tuotteet
    • Ostoskori
    • Checkout
    • Tilaukset
    • Admin‑paneeli
Phase 2 — Enhancements
    • Admin‑kirjautumissuojaus
    • Kuvien optimointi
    • Dashboard‑kaaviot
Phase 3 — Premium Features
    • Maksutavat (Paytrail / Stripe)
    • Asiakastilit
    • Tilauksen sähköpostivahvistus
📄 Lisenssi
Tämä projekti on Jarin oma kehitysprojekti. Lisenssi voidaan lisätä myöhemmin (MIT / GPL / Proprietary).
