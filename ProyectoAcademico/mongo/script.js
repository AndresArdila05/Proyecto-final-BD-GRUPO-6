// Creación de la colección 'Sede'
db.Sede.drop();
db.createCollection('Sede');
db.Sede.createIndex({ codigo_sede: 1 }, { unique: true });

// Creación de la colección 'Facultad'
db.Facultad.drop();
db.createCollection('Facultad');
db.Facultad.createIndex({ codigo_facultad: 1, Sede_codigo_sede: 1 }, { unique: true });
db.Facultad.createIndex({ Sede_codigo_sede: 1 });

// Creación de la colección 'Departamento'
db.Departamento.drop();
db.createCollection('Departamento');
db.Departamento.createIndex({ codigo_depto: 1, Facultad_codigo_facultad: 1, Facultad_Sede_codigo_sede: 1 }, { unique: true });
db.Departamento.createIndex({ Facultad_codigo_facultad: 1, Facultad_Sede_codigo_sede: 1 });

// Creación de la colección 'Carrera'
db.Carrera.drop();
db.createCollection('Carrera');
db.Carrera.createIndex({ codigo_carrera: 1, Departamento_codigo_depto: 1, Departamento_Facultad_codigo_facultad: 1, Departamento_Facultad_Sede_codigo_sede: 1 }, { unique: true });
db.Carrera.createIndex({ Departamento_codigo_depto: 1, Departamento_Facultad_codigo_facultad: 1, Departamento_Facultad_Sede_codigo_sede: 1 });

// Creación de la colección 'Edificio'
db.Edificio.drop();
db.createCollection('Edificio');
db.Edificio.createIndex({ codigo_edificio: 1, Facultad_codigo_facultad: 1, Facultad_Sede_codigo_sede: 1 }, { unique: true });
db.Edificio.createIndex({ Facultad_codigo_facultad: 1, Facultad_Sede_codigo_sede: 1 });

// Creación de la colección 'Salon'
db.Salon.drop();
db.createCollection('Salon');
db.Salon.createIndex({ numero_salon: 1, Edificio_codigo_edificio: 1, Edificio_Facultad_codigo_facultad: 1, Edificio_Facultad_Sede_codigo_sede: 1 }, { unique: true });
db.Salon.createIndex({ Edificio_codigo_edificio: 1, Edificio_Facultad_codigo_facultad: 1, Edificio_Facultad_Sede_codigo_sede: 1 });

// Creación de la colección 'Asignatura'
db.Asignatura.drop();
db.createCollection('Asignatura');
db.Asignatura.createIndex({ codigo_asignatura: 1 }, { unique: true });

// Creación de la colección 'Profesor'
db.Profesor.drop();
db.createCollection('Profesor');
db.Profesor.createIndex({ documento_profesor: 1 }, { unique: true });
db.Profesor.createIndex({ Departamento_codigo_depto: 1, Departamento_Facultad_codigo_facultad: 1, Departamento_Facultad_Sede_codigo_sede: 1 });

// Creación de la colección 'Grupo'
db.Grupo.drop();
db.createCollection('Grupo');
db.Grupo.createIndex({ num_grupo: 1, Asignatura_codigo_asignatura: 1 }, { unique: true });
db.Grupo.createIndex({ Asignatura_codigo_asignatura: 1 });
db.Grupo.createIndex({ Profesor_documento_profesor: 1 });

// Creación de la colección 'Espacio'
db.Espacio.drop();
db.createCollection('Espacio');
db.Espacio.createIndex({ dia: 1, franja_horaria: 1, Grupo_num_grupo: 1, Grupo_Asignatura_codigo_asignatura: 1, Salon_numero_salon: 1 }, { unique: true });
db.Espacio.createIndex({ Grupo_num_grupo: 1, Grupo_Asignatura_codigo_asignatura: 1, Salon_numero_salon: 1 });
