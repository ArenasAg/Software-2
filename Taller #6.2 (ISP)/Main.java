public class Main {
    public static void main(String[] args) {
        PaquetePequeno paquetePequeño = new PaquetePequenoImpl(2.0, "10x10x10", 100.0);
        PaqueteGrande paqueteGrande = new PaqueteGrandeImpl(10.0, "50x50x50", 100.0, "Aéreo");
        PaquetePeligroso paquetePeligroso = new PaquetePeligrosoImpl(5.0, "30x30x30", "Inflamable", true);

        paquetePequeño.calcularCostoEnvio();
        paquetePequeño.verificarContenido();
        paquetePequeño.verificarValorDeclarado();

        paqueteGrande.calcularCostoEnvio();
        paqueteGrande.verificarContenido();
        paqueteGrande.verificarMedioTransporte();

        paquetePeligroso.calcularCostoEnvio();
        paquetePeligroso.verificarContenido();
        paquetePeligroso.verificarEtiquetasDePeligro();
        paquetePeligroso.asegurarEmbalajeEspecial();
    }
}