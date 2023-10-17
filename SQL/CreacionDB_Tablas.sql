use Master
GO
CREATE DATABASE [DBvotaciones]
GO
use DBvotaciones
GO
CREATE
  TABLE CANDIDATO
  (
    id_candidato INTEGER NOT NULL ,
    nombre_cand  VARCHAR (255) NOT NULL ,
    codigo_cand  VARCHAR (15)
  )
  ON "default"
GO
ALTER TABLE CANDIDATO ADD CONSTRAINT CANDIDATO_PK PRIMARY KEY CLUSTERED (
id_candidato)
WITH
  (
    ALLOW_PAGE_LOCKS = ON ,
    ALLOW_ROW_LOCKS  = ON
  )
  ON "default"
GO

CREATE
  TABLE COMUNA
  (
    id_comuna  INTEGER NOT NULL ,
    nom_comuna VARCHAR (255) NOT NULL ,
    id_region  INTEGER NOT NULL
  )
  ON "default"
GO
ALTER TABLE COMUNA ADD CONSTRAINT COMUNA_PK PRIMARY KEY CLUSTERED (id_comuna)
WITH
  (
    ALLOW_PAGE_LOCKS = ON ,
    ALLOW_ROW_LOCKS  = ON
  )
  ON "default"
GO

CREATE
  TABLE REGION
  (
    id_region  INTEGER NOT NULL ,
    nom_region VARCHAR (255) NOT NULL
  )
  ON "default"
GO
ALTER TABLE REGION ADD CONSTRAINT REGION_PK PRIMARY KEY CLUSTERED (id_region)
WITH
  (
    ALLOW_PAGE_LOCKS = ON ,
    ALLOW_ROW_LOCKS  = ON
  )
  ON "default"
GO

CREATE
  TABLE VOTO
  (
    id_voto INTEGER NOT NULL ,
    rut     VARCHAR (10) NOT NULL ,
    nombre  VARCHAR (255) NOT NULL ,
    ALIAS   VARCHAR (255) NOT NULL ,
    mail    VARCHAR (255) NOT NULL ,
    web BIT NOT NULL ,
    tv BIT NOT NULL ,
    rrss BIT NOT NULL ,
    amigo BIT NOT NULL ,
    id_comuna    INTEGER ,
    id_candidato INTEGER,
    fecha DATETIME 
  )
  ON "default"
GO
ALTER TABLE VOTO ADD CONSTRAINT VOTO_PK PRIMARY KEY CLUSTERED (id_voto)
WITH
  (
    ALLOW_PAGE_LOCKS = ON ,
    ALLOW_ROW_LOCKS  = ON
  )
  ON "default"
GO

ALTER TABLE COMUNA
ADD CONSTRAINT COMUNA_REGION_FK FOREIGN KEY
(
id_region
)
REFERENCES REGION
(
id_region
)
ON
DELETE
  NO ACTION ON
UPDATE NO ACTION
GO

ALTER TABLE VOTO
ADD CONSTRAINT VOTO_CANDIDATO_FK FOREIGN KEY
(
id_candidato
)
REFERENCES CANDIDATO
(
id_candidato
)
ON
DELETE
  NO ACTION ON
UPDATE NO ACTION
GO

ALTER TABLE VOTO
ADD CONSTRAINT VOTO_COMUNA_FK FOREIGN KEY
(
id_comuna
)
REFERENCES COMUNA
(
id_comuna
)
ON
DELETE
  NO ACTION ON
UPDATE NO ACTION
GO