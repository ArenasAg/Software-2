public class Main{
    
    public static void main(String[] args) {
        ICanalNotificacion canalcorreo = new CanalCorreoElectronico();
        ICanalNotificacion canalsms = new CanalSMS();
        ICanalNotificacion canalwhatsapp = new CanalWhatsApp();

        Notificador notificador = new Notificador(canalcorreo);

        Notificacion notificacion = new Notificacion("nueva notificaion", "Hola, esta es una nueva notificación");

        notificador.enviarNotificacion(notificacion);
        

        // Cambiar el canal a SMS y enviar la notificación
        notificador.setCanal(canalsms);
        notificador.enviarNotificacion(notificacion);

        // Cambiar el canal a WhatsApp y enviar la notificación
        notificador.setCanal(canalwhatsapp);
        notificador.enviarNotificacion(notificacion);
        
    }
}