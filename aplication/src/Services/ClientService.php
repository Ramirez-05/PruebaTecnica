<?php

namespace Xyz\PruebaTecnica\Services;

use Xyz\PruebaTecnica\Models\Client;
use Exception;

class ClientService
{
    /**
     * Create a new client
     * 
     * @param array $data
     * @return Client
     * @throws Exception
     */
    public function store($data)
    {
        if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
            throw new Exception('Todos los campos son obligatorios.'); 
        }

        if (Client::where('email', $data['email'])->exists()) {
            throw new Exception('El correo electrónico ya está registrado.'); 
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        return Client::create($data);
    }

    /**
     * Get a client by ID
     * 
     * @param int $id
     * @return Client
     * @throws Exception
     */
    public function show($id)
    {
        $client = Client::find($id);
        if (!$client) {
            throw new Exception('Cliente no encontrado.');
        }

        return $client;
    }

    /**
     * Get all clients
     * 
     * @return Collection
     */
    public function index() 
    {
        return Client::all(); 
    }

    /**
     * Update a client
     * 
     * @param int $id
     * @param array $data
     * @return Client
     * @throws Exception
     */
    public function update($id, $data)
    {
        $client = Client::find($id);

        if (!$client) {
            throw new Exception('Cliente no encontrado.'); 
        }

        $id = (int)$id;
        $updated = false;

        if (isset($data['email'])) {
            if (empty($data['email'])) {
                throw new Exception('El correo electrónico es obligatorio.'); 
            }
            
            $existingClient = Client::where('email', $data['email'])->first();
            if ($existingClient && $existingClient->id !== $id) { 
                throw new Exception('El correo electrónico ya está registrado por otro usuario.');
            }

            $client->email = $data['email'];
            $updated = true;
        }

        if (isset($data['name'])) {
            if (empty($data['name'])) {
                throw new Exception('El nombre es obligatorio.'); 
            }
            
            $client->name = $data['name'];
            $updated = true;
        }

        if ($updated) {
            $client->save();
            $client = Client::find($id);
            
            if (isset($data['email']) && $client->email !== $data['email']) {
                throw new Exception('No se pudo actualizar el correo electrónico.');
            }
            
            if (isset($data['name']) && $client->name !== $data['name']) {
                throw new Exception('No se pudo actualizar el nombre.');
            }
        }

        return $client;
    }

    /**
     * Delete a client
     * 
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function destroy($id)
    {
        $client = Client::find($id); 

        if (!$client) {
            throw new Exception('Cliente no encontrado.'); 
        }

        $client->delete(); 
        return true;
    }
} 