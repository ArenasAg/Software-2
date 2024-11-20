public class ImpresoraLaserAdapter implements Impresora {
    private ImpresoraLaser impresoraLaser;

    public ImpresoraLaserAdapter(ImpresoraLaser impresoraLaser) {
        this.impresoraLaser = impresoraLaser;
    }

    @Override
    public void imprimir() {
        impresoraLaser.imprimirConLaser();
    }
}
