public class GeneradorCorreo {
    private ICanalNotificacion canalNotificacion;

    public GeneradorCorreo(ICanalNotificacion canalNotificacion) {
        this.canalNotificacion = canalNotificacion;
    }

    public void generarCorreo(Usuario usuario) {
        String asunto = "Correo para " + usuario.getNombre();
        String cuerpo = "Nombre: " + usuario.getNombre() + "\nIdentificación: " + usuario.getIdentificacion();
        Notificacion notificacion = new Notificacion(asunto, cuerpo);
        canalNotificacion.enviarCorreo(notificacion);
    }
}
