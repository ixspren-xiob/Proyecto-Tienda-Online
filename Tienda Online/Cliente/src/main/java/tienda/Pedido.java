package tienda;

public class Pedido {
    private int codigo;
    private java.sql.Date fecha;
    private int persona;
    private float importe;
    private int estado;
    private String domicilio;
    private String localidad;
    private String provincia;
    private String cp;

    public int getCodigo() {
        return codigo;
    }
    
    public java.sql.Date getFecha() {
        return fecha;
    }
    public int getPersona() {
        return persona;
    }
    public float getImporte() {
        return importe;
    }
    public int getEstado() {
        return estado;
    }
    public String getDomicilio() {
        return domicilio;
    }
    public String getLocalidad() {
        return localidad;
    }
    public String getProvincia() {
        return provincia;
    }
    public String getCp() {
        return cp;
    }
    public void setCodigo(int codigo) {
        this.codigo = codigo;
    }
    public void setPersona(int persona) {
        this.persona = persona;
    }
    public void setDomicilio(String domicilio) {
        this.domicilio = domicilio;
    }
    public void setLocalidad(String localidad) {
        this.localidad = localidad;
    }
    public void setProvincia(String provincia) {
        this.provincia = provincia;
    }
    public void setCp(String cp) {
        this.cp = cp;
    }
    public void setFecha(java.sql.Date fecha) {
        this.fecha = fecha;
    }
    public void setImporte(float importe) {
        this.importe = importe;
    }
    public void setEstado(int estado) {
        this.estado = estado;
    }
}
