const mongoose = require('mongoose');

const Schema = mongoose.Schema;

const stagePieceMapMongoSchema = new Schema({
  lvd: {
    type: String,
    required: [true, 'lvd is required'],
  },
  pieceNames: {
    type: Map,
    of: String,
    required: [true, 'pieceNames is required'],
  }
}, {
  collection: 'stage_piece_maps'
});
stagePieceMapMongoSchema.index({lvd: 1});

const StagePieceMapMongoModel = mongoose.model('StagePieceMap', stagePieceMapMongoSchema);

module.exports = StagePieceMapMongoModel;