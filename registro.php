<?php
define('APP_ACCESO', true);
$titulo = 'Registro de estudiante';
$descripcion = 'Registro de nuevos estudiantes en SIGEL para solicitar préstamos de equipos del laboratorio.';
$pagina_actual = 'registro.php';
require_once 'includes/encabezado.php';
?>
    <section class="eq02-formulario">
      <h1>Crear cuenta de estudiante</h1>
      <p><strong>Registro exclusivo para estudiantes de la UTP.</strong> Tus datos se usarán para identificarte al retirar un equipo.</p>
      <p class="eq02-nota">Las cuentas de laboratorista y administrador no se crean aquí: las crea el administrador del sistema.</p>
      <form action="#" method="post">
        <p class="eq02-nota">Los campos marcados con <span class="eq02-obligatorio">*</span> son obligatorios.</p>
        <fieldset>
          <legend>Datos personales</legend>
          <div class="eq02-rejilla">
            <div class="eq02-campo">
              <label for="nombre">Nombre <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <input type="text" id="nombre" name="nombre" required minlength="2" maxlength="50" autocomplete="given-name" placeholder="Ariel">
            </div>
            <div class="eq02-campo">
              <label for="apellido">Apellido <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <input type="text" id="apellido" name="apellido" required minlength="2" maxlength="50" autocomplete="family-name" placeholder="Jimenez">
            </div>
            <div class="eq02-campo">
              <label for="cedula">Cédula <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <input type="text" id="cedula" name="cedula" required pattern="[0-9]{1,2}-[0-9]{1,4}-[0-9]{1,6}" maxlength="15" autocomplete="off" placeholder="8-123-4567" title="Cédula con guiones: provincia-tomo-asiento. Ej.: 8-123-4567" aria-describedby="eq02-ayuda-cedula">
              <span class="eq02-ayuda" id="eq02-ayuda-cedula">Escríbela con guiones: 8-123-4567 (provincia-tomo-asiento).</span>
            </div>
            <div class="eq02-campo">
              <label for="fecha_nacimiento">Fecha de nacimiento <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required max="2026-10-19" autocomplete="bday">
            </div>
          </div>
        </fieldset>
        <fieldset>
          <legend>Contacto y carrera</legend>
          <div class="eq02-rejilla">
            <div class="eq02-campo">
              <label for="correo">Correo institucional <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <input type="email" id="correo" name="correo" required maxlength="100" autocomplete="email" placeholder="nombre.apellido@utp.ac.pa" pattern=".+@utp\.ac\.pa" title="Usa tu correo institucional que termina en @utp.ac.pa" aria-describedby="eq02-ayuda-correo">
              <span class="eq02-ayuda" id="eq02-ayuda-correo">Solo correos institucionales que terminan en @utp.ac.pa.</span>
            </div>
            <div class="eq02-campo">
              <label for="telefono">Teléfono celular <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <input type="tel" id="telefono" name="telefono" required pattern="6[0-9]{3}-?[0-9]{4}" maxlength="9" autocomplete="tel" placeholder="6123-4567" title="Celular de 8 dígitos que empieza en 6, con o sin guion. Ej.: 6123-4567" aria-describedby="eq02-ayuda-telefono">
              <span class="eq02-ayuda" id="eq02-ayuda-telefono">Ej.: 6123-4567 o 61234567.</span>
            </div>
            <div class="eq02-campo">
              <label for="carrera">Carrera <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <select id="carrera" name="carrera" required aria-describedby="eq02-ayuda-carrera">
                <option value="">Seleccione su carrera</option>
                <optgroup label="Facultad de Ciencias y Tecnología">
                  <option value="fct-ingenieria-en-alimentos">Licenciatura en Ingeniería en Alimentos</option>
                  <option value="fct-ingenieria-forestal">Licenciatura en Ingeniería Forestal</option>
                  <option value="fct-ingenieria-quimica">Licenciatura en Ingeniería Química</option>
                  <option value="fct-comunicacion-ejecutiva-bilingue">Licenciatura en Comunicación Ejecutiva Bilingüe</option>
                </optgroup>
                <optgroup label="Facultad de Ingeniería Civil">
                  <option value="fic-ingenieria-civil">Licenciatura en Ingeniería Civil</option>
                  <option value="fic-ingenieria-ambiental">Licenciatura en Ingeniería Ambiental</option>
                  <option value="fic-ingenieria-geologica">Licenciatura en Ingeniería Geológica</option>
                  <option value="fic-ingenieria-geomatica">Licenciatura en Ingeniería Geomática</option>
                  <option value="fic-ingenieria-maritima-portuaria">Licenciatura en Ingeniería Marítima Portuaria</option>
                  <option value="fic-ingenieria-en-administracion-de-proyectos-de-construccion">Licenciatura en Ingeniería en Administración de Proyectos de Construcción</option>
                  <option value="fic-dibujo-automatizado">Licenciatura en Dibujo Automatizado</option>
                  <option value="fic-edificaciones">Licenciatura en Edificaciones</option>
                  <option value="fic-operaciones-maritimas-y-portuarias">Licenciatura en Operaciones Marítimas y Portuarias</option>
                  <option value="fic-saneamiento-y-ambiente">Licenciatura en Saneamiento y Ambiente</option>
                  <option value="fic-topografia">Licenciatura en Topografía</option>
                  <option value="fic-modelado-y-gestion-digital-en-proyectos">Licenciatura en Modelado y Gestión Digital en Proyectos</option>
                </optgroup>
                <optgroup label="Facultad de Ingeniería Eléctrica">
                  <option value="fie-ingenieria-electrica">Licenciatura en Ingeniería Eléctrica</option>
                  <option value="fie-ingenieria-electrica-y-electronica">Licenciatura en Ingeniería Eléctrica y Electrónica</option>
                  <option value="fie-ingenieria-electromecanica">Licenciatura en Ingeniería Electromecánica</option>
                  <option value="fie-ingenieria-electronica-industrial">Licenciatura en Ingeniería Electrónica Industrial</option>
                  <option value="fie-ingenieria-electronica-y-telecomunicaciones">Licenciatura en Ingeniería Electrónica y Telecomunicaciones</option>
                  <option value="fie-ingenieria-de-control-y-automatizacion">Licenciatura en Ingeniería de Control y Automatización</option>
                  <option value="fie-ingenieria-electronica">Licenciatura en Ingeniería Electrónica</option>
                  <option value="fie-ingenieria-en-telecomunicaciones">Licenciatura en Ingeniería en Telecomunicaciones</option>
                  <option value="fie-electronica-y-sistemas-de-comunicacion">Licenciatura en Electrónica y Sistemas de Comunicación</option>
                  <option value="fie-sistemas-electricos-y-automatizacion">Licenciatura en Sistemas Eléctricos y Automatización</option>
                </optgroup>
                <optgroup label="Facultad de Ingeniería Eléctrica: técnicos">
                  <option value="fie-tecnico-en-ingenieria-electromecanica-industrial">Técnico en Ingeniería Electromecánica Industrial</option>
                  <option value="fie-tecnico-en-ingenieria-con-especializacion-en-electronica-biomedica">Técnico en Ingeniería con Especialización en Electrónica Biomédica</option>
                  <option value="fie-tecnico-en-ingenieria-con-especializacion-en-sistemas-electricos">Técnico en Ingeniería con Especialización en Sistemas Eléctricos</option>
                  <option value="fie-tecnico-en-ingenieria-con-especializacion-en-telecomunicaciones">Técnico en Ingeniería con Especialización en Telecomunicaciones</option>
                  <option value="fie-tecnico-en-ingenieria-con-especializacion-en-autotronica">Técnico en Ingeniería con Especialización en Autotrónica</option>
                </optgroup>
                <optgroup label="Facultad de Ingeniería Industrial">
                  <option value="fii-ingenieria-industrial">Licenciatura en Ingeniería Industrial</option>
                  <option value="fii-ingenieria-logistica-y-cadena-de-suministro">Licenciatura en Ingeniería Logística y Cadena de Suministro</option>
                  <option value="fii-ingenieria-mecanica-industrial">Licenciatura en Ingeniería Mecánica Industrial</option>
                  <option value="fii-ingenieria-en-seguridad-industrial-e-higiene-ocupacional">Licenciatura en Ingeniería en Seguridad Industrial e Higiene Ocupacional</option>
                  <option value="fii-gestion-administrativa">Licenciatura en Gestión Administrativa</option>
                  <option value="fii-gestion-de-la-produccion-industrial">Licenciatura en Gestión de la Producción Industrial</option>
                  <option value="fii-logistica-y-transporte-multimodal">Licenciatura en Logística y Transporte Multimodal</option>
                  <option value="fii-mercadeo-y-negocios-internacionales">Licenciatura en Mercadeo y Negocios Internacionales</option>
                  <option value="fii-recursos-humanos-y-gestion-de-la-productividad">Licenciatura en Recursos Humanos y Gestión de la Productividad</option>
                  <option value="fii-mercadeo-y-comercio-internacional">Licenciatura en Mercadeo y Comercio Internacional</option>
                </optgroup>
                <optgroup label="Facultad de Ingeniería Mecánica">
                  <option value="fim-ingenieria-mecanica">Licenciatura en Ingeniería Mecánica</option>
                  <option value="fim-ingenieria-de-mantenimiento">Licenciatura en Ingeniería de Mantenimiento</option>
                  <option value="fim-ingenieria-naval">Licenciatura en Ingeniería Naval</option>
                  <option value="fim-ingenieria-aeronautica">Licenciatura en Ingeniería Aeronáutica</option>
                  <option value="fim-ingenieria-de-energia-y-ambiente">Licenciatura en Ingeniería de Energía y Ambiente</option>
                  <option value="fim-mecanica-industrial">Licenciatura en Mecánica Industrial</option>
                  <option value="fim-refrigeracion-y-aire-acondicionado">Licenciatura en Refrigeración y Aire Acondicionado</option>
                  <option value="fim-mecanica-automotriz">Licenciatura en Mecánica Automotriz</option>
                  <option value="fim-soldadura">Licenciatura en Soldadura</option>
                  <option value="fim-administracion-de-aviacion">Licenciatura en Administración de Aviación</option>
                  <option value="fim-administracion-de-aviacion-con-opcion-a-vuelo-piloto">Licenciatura en Administración de Aviación con Opción a Vuelo (Piloto)</option>
                </optgroup>
                <optgroup label="Facultad de Ingeniería Mecánica: técnicos">
                  <option value="fim-tecnico-en-ingenieria-de-mantenimiento-de-aeronaves-con-especializacion-en-motores-y-fuselajes">Técnico en Ingeniería de Mantenimiento de Aeronaves con Especialización en Motores y Fuselajes</option>
                  <option value="fim-tecnico-en-despacho-de-vuelo">Técnico en Despacho de Vuelo</option>
                </optgroup>
                <optgroup label="Facultad de Ingeniería de Sistemas Computacionales">
                  <option value="fisc-ingenieria-de-sistemas-de-informacion">Licenciatura en Ingeniería de Sistemas de Información</option>
                  <option value="fisc-ingenieria-de-sistemas-de-informacion-gerencial">Licenciatura en Ingeniería de Sistemas de Información Gerencial</option>
                  <option value="fisc-ingenieria-de-sistemas-y-computacion">Licenciatura en Ingeniería de Sistemas y Computación</option>
                  <option value="fisc-ingenieria-de-software">Licenciatura en Ingeniería de Software</option>
                  <option value="fisc-ciberseguridad">Licenciatura en Ciberseguridad</option>
                  <option value="fisc-ciencias-de-la-computacion">Licenciatura en Ciencias de la Computación</option>
                  <option value="fisc-desarrollo-de-software">Licenciatura en Desarrollo de Software</option>
                  <option value="fisc-desarrollo-y-gestion-de-software">Licenciatura en Desarrollo y Gestión de Software</option>
                  <option value="fisc-informatica-aplicada-a-la-educacion">Licenciatura en Informática Aplicada a la Educación</option>
                  <option value="fisc-redes-informaticas">Licenciatura en Redes Informáticas</option>
                </optgroup>
                <optgroup label="Facultad de Ingeniería de Sistemas Computacionales: técnicos">
                  <option value="fisc-tecnico-en-informatica-para-la-gestion-empresarial">Técnico en Informática para la Gestión Empresarial</option>
                </optgroup>
              </select>
              <span class="eq02-ayuda" id="eq02-ayuda-carrera">Carreras de pregrado de la UTP, agrupadas por facultad.</span>
            </div>
            <div class="eq02-campo">
              <label for="semestre">Semestre <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <input type="number" id="semestre" name="semestre" required min="1" step="1" placeholder="3">
            </div>
          </div>
        </fieldset>
        <fieldset>
          <legend>Contraseña</legend>
          <div class="eq02-rejilla">
            <div class="eq02-campo">
              <label for="contrasena">Contraseña <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <input type="password" id="contrasena" name="contrasena" required minlength="8" maxlength="64" autocomplete="new-password" placeholder="Mínimo 8 caracteres">
            </div>
            <div class="eq02-campo">
              <label for="confirmar_contrasena">Confirmar contraseña <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
              <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" required minlength="8" maxlength="64" autocomplete="new-password" placeholder="Repite la contraseña">
            </div>
          </div>
          <div class="eq02-opcion">
            <input type="checkbox" id="acepta_reglamento" name="acepta_reglamento" value="1" required>
            <label for="acepta_reglamento">Acepto el reglamento de préstamos del laboratorio <span class="eq02-obligatorio" aria-hidden="true">*</span></label>
          </div>
          <p><a href="index.php#eq02-reglas">Leer las reglas de préstamo</a></p>
        </fieldset>
        <p class="eq02-acciones">
          <button type="submit" class="eq02-boton">Crear cuenta</button>
          <a href="login.php" class="eq02-boton eq02-boton-secundario">Ya tengo cuenta</a>
        </p>
      </form>
    </section>
<?php require_once 'includes/pie.php'; ?>
