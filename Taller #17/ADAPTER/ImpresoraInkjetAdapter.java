public class ImpresoraInkjetAdapter implements Impresora {
    private ImpresoraInkjet impresoraInkjet;

    public ImpresoraInkjetAdapter(ImpresoraInkjet impresoraInkjet) {
        this.impresoraInkjet = impresoraInkjet;
    }

    @Override
    public void imprimir() {
        impresoraInkjet.imprimirConTinta();
    }
}
