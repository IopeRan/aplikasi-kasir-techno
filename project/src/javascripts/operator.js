function kali() {

    let bil1 = document.getElementById("harga").value;
    let bil2 = document.getElementById("total").value;
    let hasil = parseInt(bil1) * parseInt(bil2);
        document.getElementById("hasil").value = hasil;

}

function kurang() {
    let bil3 = document.getElementById("hasil").value;
    let bil4 = document.getElementById("bayar").value;
    let hasil2 = parseInt(bil3) - parseInt(bil4);
        document.getElementById("payback").value = hasil2;
}