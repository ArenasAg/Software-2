package Quinta_pregunta;

public class Main {
    public static void main(String[] args) {
        Computador computador = new Computador();
        Celular celular = new Celular();

        Command encenderComputador = new EncenderComputadorCommand(computador);
        Command reiniciarComputador = new ReiniciarComputadorCommand(computador);
        Command suspenderComputador = new SuspenderComputadorCommand(computador);
        Command apagarComputador = new ApagarComputadorCommand(computador);

        Command encenderCelular = new EncenderCelularCommand(celular);
        Command reiniciarCelular = new ReiniciarCelularCommand(celular);
        Command suspenderCelular = new SuspenderCelularCommand(celular);
        Command apagarCelular = new ApagarCelularCommand(celular);

        Invoker invoker = new Invoker();

        System.out.println("Acciones para el Computador:");
        invoker.setCommand(encenderComputador);
        invoker.executeCommand();

        invoker.setCommand(reiniciarComputador);
        invoker.executeCommand();

        invoker.setCommand(suspenderComputador);
        invoker.executeCommand();

        invoker.setCommand(apagarComputador);
        invoker.executeCommand();

        System.out.println("\nAcciones para el Celular:");
        invoker.setCommand(encenderCelular);
        invoker.executeCommand();

        invoker.setCommand(reiniciarCelular);
        invoker.executeCommand();

        invoker.setCommand(suspenderCelular);
        invoker.executeCommand();

        invoker.setCommand(apagarCelular);
        invoker.executeCommand();
    }
}
