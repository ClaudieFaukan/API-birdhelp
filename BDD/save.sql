--
-- PostgreSQL database dump
--

-- Dumped from database version 14.4
-- Dumped by pg_dump version 14.4

-- Started on 2022-08-30 11:25:45

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = "heap";

--
-- TOC entry 212 (class 1259 OID 16403)
-- Name: animal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "public"."animal" (
    "id" integer NOT NULL,
    "color" character varying(255),
    "categorie_id" integer
);


ALTER TABLE "public"."animal" OWNER TO "postgres";

--
-- TOC entry 210 (class 1259 OID 16401)
-- Name: animal_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "public"."animal_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "public"."animal_id_seq" OWNER TO "postgres";

--
-- TOC entry 219 (class 1259 OID 24577)
-- Name: category; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "public"."category" (
    "id" integer NOT NULL,
    "name" character varying(255) NOT NULL
);


ALTER TABLE "public"."category" OWNER TO "postgres";

--
-- TOC entry 218 (class 1259 OID 24576)
-- Name: category_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "public"."category_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "public"."category_id_seq" OWNER TO "postgres";

--
-- TOC entry 209 (class 1259 OID 16395)
-- Name: doctrine_migration_versions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "public"."doctrine_migration_versions" (
    "version" character varying(191) NOT NULL,
    "executed_at" timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    "execution_time" integer
);


ALTER TABLE "public"."doctrine_migration_versions" OWNER TO "postgres";

--
-- TOC entry 215 (class 1259 OID 16418)
-- Name: fiche; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "public"."fiche" (
    "id" integer NOT NULL,
    "helper_id" integer,
    "animal_id" integer,
    "healthstatus_id" integer,
    "category_id" integer,
    "date" timestamp(0) without time zone NOT NULL,
    "photo" character varying(255) DEFAULT NULL::character varying,
    "description" "text",
    "coordinate_id" integer
);


ALTER TABLE "public"."fiche" OWNER TO "postgres";

--
-- TOC entry 214 (class 1259 OID 16417)
-- Name: fiche_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "public"."fiche_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "public"."fiche_id_seq" OWNER TO "postgres";

--
-- TOC entry 217 (class 1259 OID 16436)
-- Name: geographic_coordinate; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "public"."geographic_coordinate" (
    "id" integer NOT NULL,
    "fiche_id" integer,
    "longitude" character varying(255) NOT NULL,
    "lattitude" character varying(255) NOT NULL,
    "diff_dist" double precision
);


ALTER TABLE "public"."geographic_coordinate" OWNER TO "postgres";

--
-- TOC entry 216 (class 1259 OID 16435)
-- Name: geographic_coordinate_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "public"."geographic_coordinate_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "public"."geographic_coordinate_id_seq" OWNER TO "postgres";

--
-- TOC entry 221 (class 1259 OID 24583)
-- Name: health_status; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "public"."health_status" (
    "id" integer NOT NULL,
    "status" character varying(255) NOT NULL
);


ALTER TABLE "public"."health_status" OWNER TO "postgres";

--
-- TOC entry 220 (class 1259 OID 24582)
-- Name: health_status_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "public"."health_status_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "public"."health_status_id_seq" OWNER TO "postgres";

--
-- TOC entry 213 (class 1259 OID 16410)
-- Name: user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "public"."user" (
    "id" integer NOT NULL,
    "first_name" character varying(255),
    "last_name" character varying(255),
    "email" character varying(255) NOT NULL
);


ALTER TABLE "public"."user" OWNER TO "postgres";

--
-- TOC entry 211 (class 1259 OID 16402)
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "public"."user_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "public"."user_id_seq" OWNER TO "postgres";

--
-- TOC entry 3365 (class 0 OID 16403)
-- Dependencies: 212
-- Data for Name: animal; Type: TABLE DATA; Schema: public; Owner: postgres
--


--
-- TOC entry 3372 (class 0 OID 24577)
-- Dependencies: 219
-- Data for Name: category; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3362 (class 0 OID 16395)
-- Dependencies: 209
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3368 (class 0 OID 16418)
-- Dependencies: 215
-- Data for Name: fiche; Type: TABLE DATA; Schema: public; Owner: postgres
--


--
-- TOC entry 3370 (class 0 OID 16436)
-- Dependencies: 217
-- Data for Name: geographic_coordinate; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3374 (class 0 OID 24583)
-- Dependencies: 221
-- Data for Name: health_status; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3366 (class 0 OID 16410)
-- Dependencies: 213
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--




--
-- TOC entry 3380 (class 0 OID 0)
-- Dependencies: 210
-- Name: animal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"public"."animal_id_seq"', 121, true);


--
-- TOC entry 3381 (class 0 OID 0)
-- Dependencies: 218
-- Name: category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"public"."category_id_seq"', 10, true);


--
-- TOC entry 3382 (class 0 OID 0)
-- Dependencies: 214
-- Name: fiche_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"public"."fiche_id_seq"', 110, true);


--
-- TOC entry 3383 (class 0 OID 0)
-- Dependencies: 216
-- Name: geographic_coordinate_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"public"."geographic_coordinate_id_seq"', 105, true);


--
-- TOC entry 3384 (class 0 OID 0)
-- Dependencies: 220
-- Name: health_status_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"public"."health_status_id_seq"', 4, true);


--
-- TOC entry 3385 (class 0 OID 0)
-- Dependencies: 211
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"public"."user_id_seq"', 61, true);


--
-- TOC entry 3198 (class 2606 OID 16409)
-- Name: animal animal_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "public"."animal"
    ADD CONSTRAINT "animal_pkey" PRIMARY KEY ("id");


--
-- TOC entry 3213 (class 2606 OID 24581)
-- Name: category category_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "public"."category"
    ADD CONSTRAINT "category_pkey" PRIMARY KEY ("id");


--
-- TOC entry 3196 (class 2606 OID 16400)
-- Name: doctrine_migration_versions doctrine_migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "public"."doctrine_migration_versions"
    ADD CONSTRAINT "doctrine_migration_versions_pkey" PRIMARY KEY ("version");


--
-- TOC entry 3203 (class 2606 OID 16422)
-- Name: fiche fiche_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "public"."fiche"
    ADD CONSTRAINT "fiche_pkey" PRIMARY KEY ("id");


--
-- TOC entry 3210 (class 2606 OID 16442)
-- Name: geographic_coordinate geographic_coordinate_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "public"."geographic_coordinate"
    ADD CONSTRAINT "geographic_coordinate_pkey" PRIMARY KEY ("id");


--
-- TOC entry 3215 (class 2606 OID 24587)
-- Name: health_status health_status_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "public"."health_status"
    ADD CONSTRAINT "health_status_pkey" PRIMARY KEY ("id");


--
-- TOC entry 3201 (class 2606 OID 16416)
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "public"."user"
    ADD CONSTRAINT "user_pkey" PRIMARY KEY ("id");


--
-- TOC entry 3204 (class 1259 OID 24602)
-- Name: idx_4c13cc7812469de2; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "idx_4c13cc7812469de2" ON "public"."fiche" USING "btree" ("category_id");


--
-- TOC entry 3205 (class 1259 OID 24601)
-- Name: idx_4c13cc78ad123873; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "idx_4c13cc78ad123873" ON "public"."fiche" USING "btree" ("healthstatus_id");


--
-- TOC entry 3206 (class 1259 OID 16423)
-- Name: idx_4c13cc78d7693e95; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "idx_4c13cc78d7693e95" ON "public"."fiche" USING "btree" ("helper_id");


--
-- TOC entry 3199 (class 1259 OID 24608)
-- Name: idx_6aab231fbcf5e72d; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "idx_6aab231fbcf5e72d" ON "public"."animal" USING "btree" ("categorie_id");


--
-- TOC entry 3211 (class 1259 OID 16443)
-- Name: idx_ea3159e2df522508; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "idx_ea3159e2df522508" ON "public"."geographic_coordinate" USING "btree" ("fiche_id");


--
-- TOC entry 3207 (class 1259 OID 16424)
-- Name: uniq_4c13cc788e962c16; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX "uniq_4c13cc788e962c16" ON "public"."fiche" USING "btree" ("animal_id");


--
-- TOC entry 3208 (class 1259 OID 24626)
-- Name: uniq_4c13cc7898bbe953; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX "uniq_4c13cc7898bbe953" ON "public"."fiche" USING "btree" ("coordinate_id");


--
-- TOC entry 3220 (class 2606 OID 24596)
-- Name: fiche fk_4c13cc7812469de2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "public"."fiche"
    ADD CONSTRAINT "fk_4c13cc7812469de2" FOREIGN KEY ("category_id") REFERENCES "public"."category"("id");


--
-- TOC entry 3218 (class 2606 OID 16430)
-- Name: fiche fk_4c13cc788e962c16; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "public"."fiche"
    ADD CONSTRAINT "fk_4c13cc788e962c16" FOREIGN KEY ("animal_id") REFERENCES "public"."animal"("id");


--
-- TOC entry 3221 (class 2606 OID 24621)
-- Name: fiche fk_4c13cc7898bbe953; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "public"."fiche"
    ADD CONSTRAINT "fk_4c13cc7898bbe953" FOREIGN KEY ("coordinate_id") REFERENCES "public"."geographic_coordinate"("id");


--
-- TOC entry 3219 (class 2606 OID 24591)
-- Name: fiche fk_4c13cc78ad123873; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "public"."fiche"
    ADD CONSTRAINT "fk_4c13cc78ad123873" FOREIGN KEY ("healthstatus_id") REFERENCES "public"."health_status"("id");


--
-- TOC entry 3217 (class 2606 OID 16425)
-- Name: fiche fk_4c13cc78d7693e95; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "public"."fiche"
    ADD CONSTRAINT "fk_4c13cc78d7693e95" FOREIGN KEY ("helper_id") REFERENCES "public"."user"("id");


--
-- TOC entry 3216 (class 2606 OID 24603)
-- Name: animal fk_6aab231fbcf5e72d; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "public"."animal"
    ADD CONSTRAINT "fk_6aab231fbcf5e72d" FOREIGN KEY ("categorie_id") REFERENCES "public"."category"("id");


--
-- TOC entry 3222 (class 2606 OID 16444)
-- Name: geographic_coordinate fk_ea3159e2df522508; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "public"."geographic_coordinate"
    ADD CONSTRAINT "fk_ea3159e2df522508" FOREIGN KEY ("fiche_id") REFERENCES "public"."fiche"("id");


-- Completed on 2022-08-30 11:25:46

--
-- PostgreSQL database dump complete
--

