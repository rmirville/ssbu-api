const mongoose = require('mongoose');
const StagePieceMapMongoModel = require('./stage-piece-map-mongo-model');

const Schema = mongoose.Schema;
const StagePieceMapMongoSchema = StagePieceMapMongoModel.schema;

const stagePieceMapSetMongoSchema = new Schema({
  name: {
    type: String,
    required: [true, 'name is required'],
  },
  maps: {
    type: [StagePieceMapMongoSchema],
  }
}, {
  collection: 'stage_piece_map_sets'
});
stagePieceMapSetMongoSchema.index({name: 1});

const StagePieceMapSetMongoModel = mongoose.model('StagePieceMapSet', stagePieceMapSetMongoSchema);

module.exports = StagePieceMapSetMongoModel;
