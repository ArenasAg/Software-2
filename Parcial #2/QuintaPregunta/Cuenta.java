package QuintaPregunta;

import java.util.List;

public class Cuenta {
    private String titular;
    private String numeroCuenta;
    private double saldo;

    public Cuenta(String titular, String numeroCuenta, double saldo){
        this.titular = titular;
        this.numeroCuenta = numeroCuenta;
        this.saldo = saldo;
    }

    public String getNumeroCuenta(){
        return numeroCuenta;
    }

    public String getTitular() {
        return titular;
    }

    public double getSaldo() {
        return saldo;
    }

    public void setTitular(String titular) {
        this.titular = titular;
    }

    public void setNumeroCuenta(String numeroCuenta) {
        this.numeroCuenta = numeroCuenta;
    }

    public void setSaldo(double saldo) {
        this.saldo = saldo;
    }
}

class Banco {
    List<Cuenta> cuentas;
    public Banco(List<Cuenta> cuentas){
        this.cuentas = cuentas;
    }
    public Banco(){}
    public List<Cuenta> getCuentas(){
        return cuentas;
    }
    public void setCuentas(List<Cuenta> cuentas){
        this.cuentas = cuentas;
    }
    public void depositar(String numeroCuenta, double cantidad){
        if(cantidad <= 0){
            throw new IllegalAccessException("La cantidad debe ser mayor que 0");
        }
        for(Cuenta cuenta: cuentas){
            if(cuenta.getNumeroCuenta().equals(numeroCuenta)){
                double saldo = cuenta.getSaldo() + cantidad;
                cuenta.setSaldo(saldo);
                return;
            }
        }
        throw new IllegalArgumentException("No existe el numero de cuenta");
    }
    public void retirar(String numeroCuenta, double cantidad){
        if(cantidad <= 0){
            throw new IllegalArgumentException("La cantidad debe ser mayor a 0");
        }
        for(Cuenta cuenta: cuentas){
            if(cuenta.getNumeroCuenta().equals())
        }
    }
}