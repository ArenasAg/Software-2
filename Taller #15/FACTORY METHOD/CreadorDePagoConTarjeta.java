class CreadorDePagoConTarjeta extends CreadorDePago {
    @Override
    public MetodoDePago crearMetodoDePago() {
        return new PagoConTarjeta();
    }
}