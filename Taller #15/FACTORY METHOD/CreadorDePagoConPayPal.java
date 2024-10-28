class CreadorDePagoConPayPal extends CreadorDePago {
    @Override
    public MetodoDePago crearMetodoDePago() {
        return new PagoConPayPal();
    }
}