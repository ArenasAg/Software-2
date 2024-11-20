public class Main {
    public static void main(String[] args) {
        Impresora impresoraInkjet = new ImpresoraInkjetAdapter(new ImpresoraInkjet());
        Impresora impresoraLaser = new ImpresoraLaserAdapter(new ImpresoraLaser());
        impresoraInkjet.imprimir();
        impresoraLaser.imprimir();
    }
}
