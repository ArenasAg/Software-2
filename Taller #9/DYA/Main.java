public class Main {
    public void condicional(String email){
        if(!email.contains("@") || !email.contains(".")){
            System.out.println("El email  inválido");
        }else{
            System.out.println("El email es válido");
        }
    }
    public static void main(String[] args) {
        Main main = new Main();
        main.condicional("ola@.");
    }
}