package com.softpang.apiAvikarMantenimiento.Controlador;

import com.softpang.apiAvikarMantenimiento.Entity.EmpleadoEntity;
import com.softpang.apiAvikarMantenimiento.Servicio.EmpleadoServicio;
import org.json.JSONException;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.io.IOException;
import java.net.URI;
import java.net.http.*;
import java.util.ArrayList;

import org.json.JSONObject;

@RestController
@RequestMapping("/api/empleado")
@CrossOrigin
public class EmpleadoControlador {

    @Autowired
    private EmpleadoServicio empleadoSer;

    private String message = ""; private HttpStatus status;

    public Integer obtenerRol(Integer id) {
        
        Integer rolId = 0;
        try {
            HttpRequest request = HttpRequest.newBuilder()
                    .uri(URI.create("http://localhost:8082/api/roles/listar/" + id))
                    .method("GET", HttpRequest.BodyPublishers.noBody())
                    .build();
            HttpResponse<String> response = HttpClient.newHttpClient().send(request, HttpResponse.BodyHandlers.ofString());

            JSONObject json = new JSONObject(response.body()); //Parseamos nuestro response a json

            rolId =  Integer.parseInt(json.getString("rol").toString()); //Obtenemos el Id y lo parseamos Integer
            
        }catch (JSONException | IOException | InterruptedException json){

        }

        return rolId;
    }

    @GetMapping("/listar")
    public ResponseEntity<ArrayList<EmpleadoEntity>> listarAll(){
        ArrayList<EmpleadoEntity> lista = empleadoSer.listarAll();

        return ResponseEntity.ok(lista);
    }

    @GetMapping("/listar/{id}")
    public ResponseEntity<EmpleadoEntity> buscarPorId(@PathVariable("id") Integer id){

        if(!empleadoSer.existsById(id)){
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);

        }else{

            EmpleadoEntity resul = empleadoSer.buscarPorId(id).get();
            return new ResponseEntity(resul, HttpStatus.OK);
        }
    }

    @PostMapping("/save")
    public ResponseEntity<?> save(@RequestBody EmpleadoEntity empleado){

        if (empleadoSer.existsByDni(empleado.getNumerodocumento())){
            message = "MSG_0005"; status = HttpStatus.BAD_REQUEST;

        }else if(
                (empleado.getNumerodocumento() == "") ||
                (empleado.getNombres() == "") ||
                (empleado.getApellidos() == "") ||
                (empleado.getDireccion() == "") ||
                (empleado.getRol() == 0)){

            message = "MSG_0040"; status = HttpStatus.BAD_REQUEST;

        }else if(empleado.getRol() !=  obtenerRol(empleado.getRol())){
            message = "MSG_0006"; status = HttpStatus.NOT_FOUND;

        }else{
            empleado.setUsuario(empleado.getNumerodocumento());
            empleadoSer.mantenimientoData(empleado);

            message = "MSG_0001"; status = HttpStatus.OK;
        }

        return new ResponseEntity(message, status);
    }

    @PutMapping("/update/{id}")
    public ResponseEntity<?> update(@PathVariable("id") Integer id, @RequestBody EmpleadoEntity empleado){

        if (!empleadoSer.existsById(id)){
            message = "MSG_0006"; status = HttpStatus.NOT_FOUND;

        }else if(
                (empleado.getNumerodocumento() == "") ||
                        (empleado.getNombres() == "") ||
                        (empleado.getApellidos() == "") ||
                        (empleado.getDireccion() == "")){

            message = "MSG_0040"; status = HttpStatus.BAD_REQUEST;

        }else if(empleado.getRol() != obtenerRol(empleado.getRol())){
            message = "MSG_0006"; status = HttpStatus.NOT_FOUND;

        } else if(empleadoSer.existsByDni(empleado.getNumerodocumento()) && empleadoSer.buscarPorNumeroDocumento(empleado.getNumerodocumento()).get().getPersona() != id){
            message = "MSG_0005"; status = HttpStatus.BAD_REQUEST;
        }else{

            EmpleadoEntity entity = empleadoSer.buscarPorId(id).get();

            entity.setNumerodocumento(empleado.getNumerodocumento());
            entity.setNombres(empleado.getNombres());
            entity.setApellidos(empleado.getApellidos());
            entity.setDireccion(empleado.getDireccion());
            entity.setTelefono(empleado.getTelefono());
            entity.setRol(empleado.getRol());
            entity.setActivo(empleado.getActivo());

            empleadoSer.mantenimientoData(entity);
            message = "MSG_0002"; status = HttpStatus.OK;
        }
        return new ResponseEntity(message, status);
    }

    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> delete(@PathVariable("id") Integer id){

        try {
            if(!empleadoSer.existsById(id)){
                message = "MSG_0006"; status = HttpStatus.NOT_FOUND;
            }else{
                empleadoSer.delete(id);
                message = ""; status = HttpStatus.OK;
            }
            return new ResponseEntity(message, status);

        }catch (Exception ex){
            return new ResponseEntity("MSG_0030", HttpStatus.CONFLICT);
        }

    }
}
